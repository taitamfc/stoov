<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Throwable;

class AdminPackageController extends Controller
{
	public function index(Request $request)
	{
		if (auth()->user()->role_users_id == \App\User::ADMINISTRATOR) {
			$packages = Package::get();

			if (request()->ajax()) {
				return  datatables()->of($packages)
					->setRowId(function ($row) {
						return $row->id;
					})
					->addColumn('key', function ($data) {
						return $data->key;
					})
					->addColumn('value', function ($data) {
						return htmlspecialchars($data->value);
					})
					->addColumn('price', function ($data) {
						return getNumberFormat($data->price);
					})
					->addColumn('status', function ($data) {
						return $data->status ? __("Yes") : __("No");
					})
					->addColumn('is_active', function ($data) {
						return $data->is_active ? __("Actief") : __("Vervallen");
					})
					->addColumn('percentage', function ($data) {
						return (int) $data->percentage;
					})
					->addColumn('thema', function ($data) {
						return str_replace("&amp;", "&", $data->thema);
					})
					->addColumn('action', function ($data) {
						$button = '';
						if (!!auth()->user()) {
							$button .= '<a type="button" data-id="' . $data->id . '" class="btn-edit btn btn-primary btn-sm" title="View Details"><i class="dripicons-preview"></i></button></a>';
							$button .= '&nbsp;&nbsp;&nbsp;';
							$button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="dripicons-trash"></i></button>';
							$button .= '&nbsp;&nbsp;&nbsp;';
						}
						return $button;
					})
					->make(true);
			}

			return view('cursus_workshop.index');
		}
		
		return response()->json(['success' => __('You are not authorized')]);
	}


	public function store(Request $request)
	{
		$logged_user = auth()->user();
		
		if (!!$logged_user) {
			if (request()->ajax()) {
				$rule = 'required';
				$params = $request->only(
					'key',
					'value',
					'price',
					'status',
					'is_active',
					'thema',
					'percentage',
					'vakcertificaat_glaszetten',
					'vakcertificaat_glasmonteur',
					'op_termijn_moeten_we_deze_gaan_bijhouden'
				);
				$params['percentage'] = (int) $request->percentage;
				$params['vakcertificaat_glaszetten'] = !!$request->vakcertificaat_glaszetten ?? 0;
				$params['vakcertificaat_glasmonteur'] = !!$request->vakcertificaat_glasmonteur ?? 0;
				$params['op_termijn_moeten_we_deze_gaan_bijhouden'] = !!$request->op_termijn_moeten_we_deze_gaan_bijhouden ?? 0;

				$validator = Validator::make(
					$params,
					[
						'value' => $rule
					],
					[
						'value.required' => 'Opleiding mag niet leeg zijn'
					]
				);

				if ($validator->fails()) {
					return response()->json(['errors' => $this->valid($validator)]);
				}

				try {
					Package::updateOrCreate([
						'value' => $params['value']
					], $params);
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

		if (!!$logged_user)
		{
			Package::whereId($id)->delete();

			return response()->json(['success' => __('Data is successfully deleted')]);
		}

		return response()->json(['success' => __('You are not authorized')]);
	}

	public function show($id)
	{
		if (request()->ajax())
		{
			$data = Package::findOrFail($id);
			$data['percentage'] = (int) $data['percentage'];
			$data['thema'] = str_replace("&amp;", "&", $data->thema);
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
					'key',
					'value',
					'price',
					'status',
					'is_active',
					'thema',
					'percentage'
				);
				$params['percentage'] = (int) $request->percentage;
				$params['vakcertificaat_glaszetten'] = !!$request->vakcertificaat_glaszetten ?? 0;
				$params['vakcertificaat_glasmonteur'] = !!$request->vakcertificaat_glasmonteur ?? 0;
				$params['op_termijn_moeten_we_deze_gaan_bijhouden'] = !!$request->op_termijn_moeten_we_deze_gaan_bijhouden ?? 0;
				$validator = Validator::make(
					$params,
					[
						'value' => $rule
					],
					[
						'value.required' => 'Opleiding mag niet leeg zijn'
					]
				);
				if ($validator->fails()) {
					return response()->json(['errors' => $this->valid($validator)]);
				}

				try {
					Package::whereId($id)->update($params);
				} catch (Exception $e) {
					return response()->json(['error' => $e->getMessage()]);

				}

				return response()->json(['success' => __('Data update successfully.')]);
			}
		}

		return response()->json(['success' => __('You are not authorized')]);
	}
}
