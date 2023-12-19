<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Client;
use App\Company;
use App\Services\CourseService;
use App\Imports\BudgettenImporteren;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;

class AdminBudgetController extends Controller
{
	/**
	 * Budget get list
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return void
	 */
	public function index(Request $request)
	{
		$budgets = Budget::when(isset($request->companyId), function ($q) use ($request) {
			$q->whereCompanyId($request->companyId);
		})
			->get();

		$budgetsList = $budgets->map(function ($budget) {
			$budget['amount'] = getNumberFormat($budget->amount);
			$budget['overheveling_budget'] = getNumberFormat($budget->overheveling_budget);
			$budget['loonsom_euro'] = getNumberFormat($budget->loonsom_euro);
			$budget['premie'] = getNumberFormat($budget->premie);
			$budget['vakbondsbijdr'] = getNumberFormat($budget->vakbondsbijdr);
			$budget['opleidingsbudget'] = getNumberFormat($budget->opleidingsbudget);

			$budget['loonsom_opgegeven'] = $budget->loonsom_opgegeven === 1 ? 'Y' : 'N';

			return $budget;
		});

		return response()->json(['data' => $budgetsList]);
	}

	/**
	 * Undocumented function
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return void
	 */
	public function store(Request $request)
	{
		$logged_user = auth()->user();

		if (!!$logged_user) {
			if (request()->ajax()) {
				$rule = 'required';
				$params = $request->only(
					'budget_jaartal',
					'amount',
					'company_id'
				);

				$validator = Validator::make(
					$params,
					[
						'budget_jaartal' => $rule . '|min:2000|max:2100|integer',
						'amount' => $rule
					],
					[
						'budget_jaartal.required' => 'The budget jaartal field is required',
						'budget_jaartal.min' => 'veldjaar moet groter zijn dan 2000 en kleiner dan 2100',
						'budget_jaartal.max' => 'veldjaar moet groter zijn dan 2000 en kleiner dan 2100',
						'amount.required' => 'The amount field is required',
					]
				);

				if ($validator->fails()) {
					return response()->json(['errors' => $this->valid($validator)]);
				}

				try {
					Budget::updateOrCreate($params);
				} catch (Exception $e) {
					return response()->json(['error' => $e->getMessage()]);
				}

				return response()->json(['success' => __('Data Added successfully.')]);
			}
		}

		return response()->json(['success' => __('You are not authorized')]);
	}

	public function destroy($id)
	{
		$logged_user = auth()->user();

		if (!!$logged_user) {
			Budget::whereId($id)->delete();

			return response()->json(['success' => __('Data is successfully deleted')]);
		}

		return response()->json(['success' => __('You are not authorized')]);
	}

	public function show($id)
	{
		if (request()->ajax()) {
			$data = Budget::findOrFail($id);

			return response()->json(['data' => $data]);
		}
	}


	public function update(Request $request, $id)
	{
		$logged_user = auth()->user();

		if (!!$logged_user) {
			if (request()->ajax()) {
				$rule = 'required';
				$params = $request->only(
					'budget_jaartal',
					'amount',
					'company_id'
				);

				$validator = Validator::make(
					$params,
					[
						'budget_jaartal' => $rule . '|min:2000|max:2100|integer',
						'amount' => $rule,
					],
					[
						'budget_jaartal.required' => 'The budget_jaartal field is required',
						'budget_jaartal.min' => 'veldjaar moet groter zijn dan 2000 en kleiner dan 2100',
						'budget_jaartal.max' => 'veldjaar moet groter zijn dan 2000 en kleiner dan 2100',
						'amount.required' => 'The amount field is required',
					]
				);
				if ($validator->fails()) {
					return response()->json(['errors' => $this->valid($validator)]);
				}

				try {
					Budget::whereId($id)->update($params);
				} catch (Exception $e) {
					return response()->json(['error' => $e->getMessage()]);
				}

				return response()->json(['success' => __('Data update successfully.')]);
			}
		}

		return response()->json(['success' => __('You are not authorized')]);
	}

	public function budgettenImporteren()
	{
		return view('budgets.budgetten-importeren');
	}

	public function postBudgettenImporteren()
	{
		try {
			Excel::import(new BudgettenImporteren(), request()->file('file'));
		} catch (Exception $e) {
			return Redirect::route('course.opleidingsvergoeding-importeren')->withErrors(['errors' => $e->getMessage()]);
		}
		$this->setSuccessMessage(__('Imported Successfully'));
		return back();
	}

	/**
	 * Get view beschikbareBudgetten
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return void
	 */
	public function beschikbareBudgetten(Request $request)
	{
		$companyId = @auth()->user()->company_id;
		$userId = @auth()->user()->id;
		$budgets = Budget::when(isset($companyId), function ($q) use ($companyId) {
				$q->whereCompanyId($companyId);
			})
			->when(isset($request->year), function ($q) use ($request) {
				$q->where('year', $request->year);
			})
			->get()
			->toArray();

		$clients = Client::when(isset($companyId), function ($q) use ($userId) {
				$q->whereId($userId);
			})->get();
		$budgetsList = $clients->map(function ($client) use ($budgets, $request) {
			$defaultValue = getNumberFormat(0);
			$budget = collect($budgets)->where('relatienummer', $client->relatienummer)->first();
			$budget['amount'] = @$budget['amount'] ? getNumberFormat($budget['amount']) : $defaultValue;
			$budget['overheveling_budget'] = @$budget['overheveling_budget'] ? getNumberFormat($budget['overheveling_budget']) : $defaultValue;
			$budget['loonsom_euro'] = @$budget['loonsom_euro'] ? getNumberFormat($budget['loonsom_euro']) : $defaultValue;
			$budget['premie'] = @$budget['premie'] ? getNumberFormat($budget['premie']) : $defaultValue;
			$budget['vakbondsbijdr'] = @$budget['vakbondsbijdr'] ? getNumberFormat($budget['vakbondsbijdr']) : $defaultValue;
			$budget['opleidingsbudget'] = @$budget['opleidingsbudget'] ? getNumberFormat($budget['opleidingsbudget']) : $defaultValue;
			$budget['datum_opgave'] = @$budget['datum_opgave'] ? formatDate($budget['datum_opgave']) : null;
			$budget['loonsom_opgegeven'] = @$budget['opleidingsbudget'] === 1 ? 'Y' : 'N';
			$budget['bedrijf'] = @$client->company->organisatie;
			$budget['id'] = @$budget['id'] ?? - 1;
			$budget['relatienummer'] = @$client->relatienummer ?? null;
			$budget['year'] = @$budget->year ?? $request->year;
			$budget['budget_jaartal'] = @$budget->budget_jaartal ?? $request->year;
			$budget['medewerkers_aantal'] = @$budget->medewerkers_aantal ?? 0;
			$companyId = @$client->company_id;
			$remainingBudget = App::make(CourseService::class)->getRemainingBudget($companyId,$request->year);
			$budget['remainingBudget'] = @$remainingBudget ? getNumberFormat($remainingBudget) : 0;
			return $budget;
		});

		$budgetsList = $budgetsList->filter(function ($item) {
			return !!$item;
		})->values();
		if (request()->ajax()) {
			return datatables()->of($budgetsList)
				->addColumn('action', function ($data) {
					if ($data['id'] !== -1) {
						$button = '<a href="' . route('beschikbare-budgetten-edit', ['id' => $data['id']]) . '" class="edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';

						return $button;
					}
				})
				->rawColumns(['action'])
				->make(true);
		}

		return view('budgets.index');
	}

	/**
	 * edit
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return void
	 */
	public function beschikbareBudgettenEdit(Request $request, $id)
	{
		$budget = Budget::findOrFail($id);
		$companies = Company::all();

		return view('budgets.edit', compact('budget', 'companies'));
	}

	public function beschikbareBudgettenUpdate(Request $request, $id)
	{

		if (request()->ajax()) {
			try {
				$params = $request->only(
					'company_id',
					'year',
					'budget_jaartal',
					'loonsom_opgegeven',
					'loonsom_euro',
					'overheveling_budget',
					'medewerkers_aantal',
					'datum_opgave'
				);
				$loonsomEuro = (float)@$params['loonsom_euro'];
				$overhevelingBudget = (float)@$params['overheveling_budget'];
				$premie = $loonsomEuro * 0.5 / 100;
				$vakbondsbijdr = $loonsomEuro * 0.024 / 100;
				$opleidingsbudget = $premie * 0.4;
				$amount = $overhevelingBudget + $opleidingsbudget;
				$params['relatienummer'] = @Company::find($params['company_id'])->client->relatienummer;
				$data = [
					'year' => @$params['year'],
					'company_id' => @$params['company_id'],
					'relatienummer' => @$params['relatienummer'],
					'budget_jaartal' => @$params['budget_jaartal'],
					'loonsom_opgegeven' => @$params['loonsom_opgegeven'] === 'Y' ? 1 : 0,
					'overheveling_budget' => @$params['overheveling_budget'],
					'loonsom_euro' => $loonsomEuro,
					'medewerkers_aantal' => @$params['medewerkers_aantal'],
					'datum_opgave' => $params['datum_opgave'] ? Carbon::parse(@$params['datum_opgave']) : null,
					'premie' => $premie,
					'vakbondsbijdr' => $vakbondsbijdr,
					'opleidingsbudget' => $opleidingsbudget,
					'amount' => $amount,
				];
				Budget::whereId($id)->update($data);
				return response()->json(['success' => __('Data update successfully.')]);
			} catch (Exception $e) {
				return response()->json(['error' => $e->getMessage()]);
			}
		}
	}
}
