<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequestStoreRequest;
use Exception;
use App\EmployeeRequest;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\DB;

class EmployeeRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role_users_id != User::ADMINISTRATOR)  return response()->json(['success' => __('You are not authorized')]);
        $templates = EmployeeRequest::get();
		if (request()->ajax()) {
			return  datatables()->of($templates)
				->setRowId(function ($row) {
					return $row->id;
				})
				->addColumn('status', function ($data) {
					$status = __('In behandeling');
					if ($data->status === EmployeeRequest::STATUS_APPROVED) {
                        $status = __('Afgerond');
					}

					return $status;
				})
                ->addColumn('company', function ($data) {
					return isset($data->client->company->organisatie) ? $data->client->company->organisatie : "";
				})
                ->addColumn('birthdate', function ($data) {
					return Carbon::createFromDate($data->birthdate)->format('d-m-Y');
				})
                ->addColumn('vca_expiry_date', function ($data) {
					return Carbon::createFromDate($data->vca_expiry_date)->format('d-m-Y');
				})
                ->addColumn('working_since', function ($data) {
					return Carbon::createFromDate($data->working_since)->format('d-m-Y');
				})
                ->addColumn('is_subcontractor', function ($data) {
					return $data->is_subcontractor == true ? __('Yes') : __('No');
				})
				->addColumn('action', function ($data) {
					$button = '';
					$button .= '<a href="'. route('employee-request.show', $data->id) . '"  class="edit btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View Details"><i class="dripicons-preview"></i></button></a>';

					return $button;
				})
				->make(true);
		}

		return view('employee_request.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee_request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\EmployeeRequestStoreRequest  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequestStoreRequest $request)
    {
        if(auth()->user()->role_users_id != User::CLIENT)  return response()->json(['success' => __('You are not authorized')]);
        try {
            $logged_user = auth()->user();
            $params = $request->validated();
            $params['user_id'] = $logged_user->id;
            $params['birthdate'] = Carbon::createFromDate($request->birthdate)->format('Y-m-d');
            $params['vca_expiry_date'] = Carbon::createFromDate($request->birthdate)->format('Y-m-d');
            $params['working_since'] = Carbon::createFromDate($request->birthdate)->format('Y-m-d');

            EmployeeRequest::create($params);
            
            return response()->json(['success' => __('Data Added successfully.')]);
            
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->user()->role_users_id != User::ADMINISTRATOR) return response()->json(['success' => __('You are not authorized')]);
        try {
            $detail = EmployeeRequest::find($id);
            $employees = Employee::whereTussenvoegsel($detail->last_name)
                ->whereGeboortedatum($detail->birthdate)
                ->get();

            return view('employee_request.show', compact('detail', 'employees'));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->role_users_id != User::ADMINISTRATOR)  return response()->json(['success' => __('You are not authorized')]);
        try {
            $detail = EmployeeRequest::find($id);

            return view('employee_request.show', compact('detail'));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->role_users_id != User::ADMINISTRATOR)  return response()->json(['success' => __('You are not authorized')]);
        try {
            $detail = EmployeeRequest::find($id);
            if($request->company_id) {
                $employee = Employee::whereLastName($detail->last_name)
                    ->where('date_of_birth', date('Y-m-d', strtotime($detail->birthdate)))
                    ->first();
                if($employee) $employee->companies()->attach($request->company_id);
            } else {
                DB::beginTransaction();
				try {
                    $params = [];
                    $params['date_of_birth'] = $detail->date_of_birth ? Carbon::createFromDate($detail->date_of_birth)->format('d-m-Y') : null;
                    $params['first_name'] = $detail->first_name;
                    $params['last_name'] =  $detail->last_name;
                    $params['vca_expiry_date'] = $detail->vca_expiry_date ? Carbon::createFromDate($detail->vca_expiry_date)->format('d-m-Y') : null;
                    $params['working_since'] =  $detail->working_since ? Carbon::createFromDate($detail->working_since)->format('d-m-Y') : null;
                    $params['is_subcontractor'] =  $detail->last_name;
                    $employee = Employee::create($params);
                    $employee->companies()->attach($detail->client->company_id);
                    DB::commit();
				} catch (Exception $e) {
					DB::rollback();

					return response()->json(['error' => $e->getMessage()]);
				}
            }

            $detail->update([
                'status' => $request->status
            ]);
            return response()->json(['success' => __('Data update successfully.')]);
        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
