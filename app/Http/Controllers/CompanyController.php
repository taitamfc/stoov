<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CompanyImport;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if (request()->ajax())
		{
			return datatables()->of(Company::all())
				->setRowId(function ($company)
				{
					return $company->id;
				})
				->addColumn('relatienummer', function ($data)
				{
					return @$data->client->relatienummer ?? '';
				})
				->addColumn('keurmerk', function ($data)
				{
					return @$data->keurmerk == 1 ? 'Y' : 'N';
				})
				->addColumn('stoov_klant', function ($data)
				{
					return @$data->details === 'No STOOV' ? 'N' : 'Y';
				})
				->addColumn('action', function ($data)
				{
					$button = '<button type="button" name="show" id="' . $data->id . '" class="show_new btn btn-success btn-sm"><i class="dripicons-preview"></i></button>';
					$button .= '&nbsp;&nbsp;';
					$button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
					$button .= '&nbsp;&nbsp;';
					$button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';
					
					return $button;
				})
				->rawColumns(['action'])
				->make(true);
		}

		return view('organization.company.index');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request)
	{
		if(auth()->user()->can('store-company'))
		{
			$validator = Validator::make($request->only(
			    'organisatie', 'straat', 'number', 'toevoeging', 'post_code',
                'plaats', 'glaskeur', 'contact_persoon', 'functie', 'telefoonnummer', 'emailadres',
                'keurmerk'
            ),
				[
					'organisatie' => 'required|unique:companies,organisatie',
					'emailadres' => 'email',
				]
			);

			if ($validator->fails())
			{
				return response()->json(['errors' => $this->valid($validator)]);
			}

			$data = [];
			$data['organisatie'] = $request->organisatie;
			$data['straat'] = $request->straat;
			$data['number'] = $request->number;
			$data['toevoeging'] = $request->toevoeging;
			$data['post_code'] = $request->post_code;
			$data['plaats'] = $request->plaats;
			$data['glaskeur'] = $request->glaskeur;
			$data['contact_persoon'] = $request->contact_persoon;
			$data['functie'] = $request->functie;
			$data['telefoonnummer'] = $request->telefoonnummer;
			$data['emailadres'] = $request->emailadres;
			$data['keurmerk'] = $request->keurmerk;
			Company::create($data);


			return response()->json(['success' => __('Data Added successfully.')]);
		}
		return response()->json(['success' => __('You are not authorized')]);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if (request()->ajax())
		{
			$data = Company::findOrFail($id)->load('client');
			$data['keurmerk'] = @$data->keurmerk == 1 ? 'Y' : 'N';
			$data['stoov_klant'] = @$data->details ? 'Y' : 'N';

			return response()->json(['data' => $data]);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{

		if (request()->ajax())
		{
			$data = Company::findOrFail($id);

			return response()->json(['data' => $data]);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{

		$logged_user = auth()->user();

		if ($logged_user->can('edit-company'))
		{
			$id = $request->hidden_id;

			$validator = Validator::make($request->only(
                'organisatie', 'straat', 'number', 'toevoeging', 'post_code',
                'plaats', 'glaskeur', 'contact_persoon', 'functie', 'telefoonnummer', 'emailadres',
                'keurmerk'

            ),
				[
					'organisatie' => 'required|unique:companies,organisatie,' . $id,
                    'emailadres' => 'nullable|email',
				]
			);


			if ($validator->fails())
			{
				return response()->json(['errors' => $this->valid($validator)]);
			}


			$data = [];
            $data['organisatie'] = $request->organisatie;
            $data['straat'] = $request->straat;
            $data['number'] = $request->number;
            $data['toevoeging'] = $request->toevoeging;
            $data['post_code'] = $request->post_code;
            $data['plaats'] = $request->plaats;
            $data['glaskeur'] = $request->glaskeur;
            $data['contact_persoon'] = $request->contact_persoon;
            $data['functie'] = $request->functie;
            $data['telefoonnummer'] = $request->telefoonnummer;
            $data['emailadres'] = $request->emailadres;
            $data['keurmerk'] = $request->keurmerk;

			Company::whereId($id)->update($data);
            $data = Company::findOrFail($id);

			return response()->json(['success' => __('Data is successfully updated'), 'data' => $data]);

		} else
		{
			return response()->json(['success' => __('You are not authorized')]);
		}


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(!env('USER_VERIFIED'))
		{
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}
		$logged_user = auth()->user();

		if ($logged_user->can('delete-company'))
		{
			Company::whereId($id)->delete();

			return response()->json(['success' => __('Data is successfully deleted')]);

		}

		return response()->json(['success' => __('You are not authorized')]);

	}


	public function delete_by_selection(Request $request)
	{
		if(!env('USER_VERIFIED'))
		{
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}
		$logged_user = auth()->user();

		if ($logged_user->can('delete-company'))
		{

			$company_id = $request['companyIdArray'];
			$company = Company::whereIn('id', $company_id);

			if ($company->delete())
			{
				return response()->json(['success' => __('Multi Delete',['key'=>trans('Company')])]);
			} else
			{
				return response()->json(['error' => 'Error,selected users can not be deleted']);
			}
		}

		return response()->json(['success' => __('You are not authorized')]);
	}


	public function import()
	{
		return view('organization.company.import');
	}

	public function importPost(Request $request)
	{
		try {
			if ($request->hasFile('file')) {
				Excel::import(new CompanyImport(), $request->file('file'));
				$this->setSuccessMessage(__('Imported Successfully'));
			} else {
				$this->setErrorMessage(__('Imported failed'));
			}
		} catch (ValidationException $e) {
			$failures = $e->failures();
			Log::error($failures);
			$this->setErrorMessage(__('Imported failed'));
		}
		return back();
	}

}


