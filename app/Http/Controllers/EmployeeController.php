<?php
namespace App\Http\Controllers;
use App\Certification;
use App\Company;
use App\department;
use App\designation;
use App\DocumentType;
use App\Employee;
use App\Imports\CertificationImport;
use App\Imports\EmployeeImport;
use App\Imports\KlantenImporteren;
use App\office_shift;
use App\PaidSalary;
use App\QualificationEducationLevel;
use App\QualificationLanguage;
use App\QualificationSkill;
use App\salary;
use App\status;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Spatie\Permission\Models\Role;
use Throwable;
use Barryvdh\DomPDF\Facade as PDF;
use App\SalaryBasic;
use Illuminate\Support\Facades\Redirect;
class EmployeeController extends Controller
{
	public function index(Request $request)
	{
		$logged_user = auth()->user();
		// $relatienummer = $logged_user->client->relatienummer;
		$companies = Company::select('id', 'organisatie')->get();
		$roles = Role::where('id', '!=', User::CLIENT)->where('is_active', 1)->select('id', 'name')->get();
		$employees = Employee::with('user:id,profile_photo,username', 'department:id,department_name', 'designation:id,designation_name', 'officeShift:id,shift_name')
			->when(isset($request->company_id), function ($q) use ($request) {
				$q->whereHas('companies', function ($q) use ($request) {
					$q->whereId($request->company_id);
				});
			})
			->when(isset($logged_user->role_users_id) && $logged_user->role_users_id == User::CLIENT, function ($q) use ($logged_user) {
				$q->whereHas('companies', function ($q) use ($logged_user) {
					$q->whereId($logged_user->client->company_id);
				});
			})
			->where(function ($q) {
				$q->where('exit_date', NULL)
					->orWhere('exit_date', '0000-00-00');
			})
			->get();
	
		if (request()->ajax()) {
			return  datatables()->of($employees)
				->setRowId(function ($row) {
					return $row->id;
				})
				->addColumn('organisatie', function ($data) {
					return implode(',',$data->companies()->pluck('organisatie')->toArray()) ?? '';
				})
				
				->addColumn('initialen', function ($data) {
					return $data->initialen;
				})
				->addColumn('toevoeging', function ($data) {
					return $data->toevoeging;
				})
				->addColumn('tussenvoegsel', function ($data) {
					return $data->tussenvoegsel;
				})
				->addColumn('achternaam', function ($data) {
					return $data->achternaam;
				})
				->addColumn('geboortedatum', function ($data) {
					return $data->geboortedatum ? date(env('Date_Format'), strtotime($data->geboortedatum)) : null;
				})
				->addColumn('geboorteplaats', function ($data) {
					return $data->geboorteplaats;
				})
				->addColumn('aktief', function ($data) {
					return $data->aktief ? __("Yes") : __("No");
				})
				->addColumn('in_dienst', function ($data) {
					return $data->in_dienst ? __("Yes") : __("No");
				})
				->addColumn('indienst_sinds', function ($data) {
					return $data->indienst_sinds ? date(env('Date_Format'), strtotime($data->indienst_sinds)) : null;
				})
				->addColumn('is_onderaannemer', function ($data) {
					return $data->is_onderaannemer ? __("Yes") : __("No");
				})
				->addColumn('onderaannemer_sinds', function ($data) {
					return $data->onderaannemer_sinds ? date(env('Date_Format'), strtotime($data->onderaannemer_sinds)) : null;
				})
				->addColumn('vevaldatum_vca', function ($data) {
					return $data->vevaldatum_vca ? date(env('Date_Format'), strtotime($data->vevaldatum_vca)) : null;
				})
				->addColumn('vervaldatum_glasmonteur', function ($data) {
					return $data->vervaldatum_glasmonteur ? date(env('Date_Format'), strtotime($data->vervaldatum_glasmonteur)) : null;
				})
				->addColumn('vervaldatum_glaszetter', function ($data) {
					return $data->vervaldatum_glaszetter ? date(env('Date_Format'), strtotime($data->vervaldatum_glaszetter)) : null;
				})
				->addColumn('action', function ($data) {
					$button = '';
					$button .= '<a href="employees/' . $data->id . '"  class="edit btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View Details"><i class="dripicons-preview"></i></button></a>';
					$button .= '<a href="employees/' . $data->id . '/edit"  class="edit btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="View Details"><i class="dripicons-pencil"></i></button></a>';
					$button .= '&nbsp;&nbsp;&nbsp;';
					if (auth()->user()->can('modify-details-employee')) {
						if ($data->role_users_id != 1) {
							$button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="dripicons-trash"></i></button>';
							$button .= '&nbsp;&nbsp;&nbsp;';
						}
					}
					return $button;
				})
				->make(true);
		}
		return view('employee.index', compact('companies', 'roles'));
	}

	public function store(Request $request)
	{
		$logged_user = auth()->user();
		if ($logged_user->can('store-details-employee')) {
			if (request()->ajax()) {
				$rule = 'required';
				$params = $request->only(
					'company_ids',
					'achternaam',
					'initialen',
					'toevoeging',
					'tussenvoegsel',
					'geboortedatum',
					'geboorteplaats',
					'aktief',
					'in_dienst',
					'indienst_sinds',
					'is_onderaannemer',
					'onderaannemer_sinds',
					'vevaldatum_vca',
					'vervaldatum_glasmonteur',
					'vervaldatum_glaszetter'
				);
				$validator = Validator::make(
					$params,
					[
						'company_ids' => $rule . '|array',
						'achternaam' => $rule,
						'initialen' => $rule,
						'toevoeging' => $rule,
						'tussenvoegsel' => $rule,
						'geboortedatum' => $rule,
						'geboorteplaats' => $rule,
						'aktief' => $rule,
						'in_dienst' => $rule,
						'indienst_sinds' => $rule,
						'is_onderaannemer' => $rule,
						'onderaannemer_sinds' => $rule,
						//'vevaldatum_vca' => $rule,
						//'vervaldatum_glasmonteur' => $rule,
						//'vervaldatum_glaszetter' => $rule,
					],[
						'required' => 'Het veld :attribute is verplicht.'
					]
				);
				if ($validator->fails()) {
					return response()->json(['errors' => $this->valid($validator)]);
				}
				DB::beginTransaction();
				try {
					unset($params['company_ids']);
					$params['geboortedatum'] = date('Y-m-d', strtotime($params['geboortedatum']));
					$params['vervaldatum_glasmonteur'] = date('Y-m-d', strtotime($params['vervaldatum_glasmonteur']));
					$params['vervaldatum_glaszetter'] = date('Y-m-d', strtotime($params['vervaldatum_glaszetter']));
					$params['vevaldatum_vca'] = date('Y-m-d', strtotime($params['vevaldatum_vca']));
					$params['onderaannemer_sinds'] = date('Y-m-d', strtotime($params['onderaannemer_sinds']));
					$params['indienst_sinds'] = date('Y-m-d', strtotime($params['indienst_sinds']));
					$employee = Employee::create($params);
					foreach($request->company_ids as $company) {
						$employee->companies()->attach($company);
					}
					
					DB::commit();
				} catch (Exception $e) {
					DB::rollback();
					return response()->json(['error' => $e->getMessage()]);
				} catch (Throwable $e) {
					DB::rollback();
					return response()->json(['error' => $e->getMessage()]);
				}
				return response()->json(['success' => __('Data Added successfully.')]);
			}
		}
		return response()->json(['success' => __('You are not authorized')]);
	}
	public function show(Employee $employee)
	{	
		$logged_user = auth()->user();
		if( isset($logged_user->role_users_id) && $logged_user->role_users_id == User::CLIENT ){
			$allEmployeesIds = Employee::query(true)
			->when(isset($logged_user->role_users_id) && $logged_user->role_users_id == User::CLIENT, function ($q) use ($logged_user) {
				$q->whereHas('companies', function ($q) use ($logged_user) {
					$q->whereId($logged_user->client->company_id);
				});
			})->pluck('id')->toArray();
			if( !in_array( $employee->id, $allEmployeesIds ) ){
				abort(403);
			}
		}
		$companies = Company::select('id', 'organisatie')->get();
		$departments = department::select('id', 'department_name')
			->where('company_id', $employee->company_id)
			->get();
		$designations = designation::select('id', 'designation_name')
			->where('department_id', $employee->department_id)
			->get();
		$office_shifts = office_shift::select('id', 'shift_name')
			->where('company_id', $employee->company_id)
			->get();
		$statuses = status::select('id', 'status_title')->get();
		// $roles = Role::select('id', 'name')->get();
		$countries = DB::table('countries')->select('id', 'name')->get();
		$document_types = DocumentType::select('id', 'document_type')->get();
		$education_levels = QualificationEducationLevel::select('id', 'name')->get();
		$language_skills = QualificationLanguage::select('id', 'name')->get();
		$general_skills = QualificationSkill::select('id', 'name')->get();
		$roles = Role::where('id', '!=', 3)->where('is_active', 1)->select('id', 'name')->get(); //--new--
		$certifications = $employee->certifications->makeHidden(['created_at', 'updated_at', 'employee_id'])->toArray();
		return view('employee.dashboard', compact(
			'employee',
			'countries',
			'companies',
			'departments',
			'designations',
			'statuses',
			'office_shifts',
			'document_types',
			'education_levels',
			'language_skills',
			'general_skills',
			'roles',
			'certifications'
		));
	}
	public function edit(Employee $employee)
	{	
		$logged_user = auth()->user();
		if( isset($logged_user->role_users_id) && $logged_user->role_users_id == User::CLIENT ){
			$allEmployeesIds = Employee::query(true)
			->when(isset($logged_user->role_users_id) && $logged_user->role_users_id == User::CLIENT, function ($q) use ($logged_user) {
				$q->whereHas('companies', function ($q) use ($logged_user) {
					$q->whereId($logged_user->client->company_id);
				});
			})->pluck('id')->toArray();
			if( !in_array( $employee->id, $allEmployeesIds ) ){
				abort(403);
			}
		}
		$companies = Company::select('id', 'organisatie')->get();
		$departments = department::select('id', 'department_name')
			->where('company_id', $employee->company_id)
			->get();
		$designations = designation::select('id', 'designation_name')
			->where('department_id', $employee->department_id)
			->get();
		$office_shifts = office_shift::select('id', 'shift_name')
			->where('company_id', $employee->company_id)
			->get();
		$statuses = status::select('id', 'status_title')->get();
		// $roles = Role::select('id', 'name')->get();
		$countries = DB::table('countries')->select('id', 'name')->get();
		$document_types = DocumentType::select('id', 'document_type')->get();
		$education_levels = QualificationEducationLevel::select('id', 'name')->get();
		$language_skills = QualificationLanguage::select('id', 'name')->get();
		$general_skills = QualificationSkill::select('id', 'name')->get();
		$roles = Role::where('id', '!=', 3)->where('is_active', 1)->select('id', 'name')->get(); //--new--
		$certifications = $employee->certifications->makeHidden(['created_at', 'updated_at', 'employee_id'])->toArray();
		return view('employee.form-edit', compact(
			'employee',
			'countries',
			'companies',
			'departments',
			'designations',
			'statuses',
			'office_shifts',
			'document_types',
			'education_levels',
			'language_skills',
			'general_skills',
			'roles',
			'certifications'
		));
	}
	public function update(Request $request,String $id)
	{
		dd($request);
		$logged_user = auth()->user();
		if ($logged_user->can('store-details-employee')) {
			if (request()->ajax()) {
				$rule = 'required';
				$params = $request->only(
					'company_ids',
					'achternaam',
					'initialen',
					'toevoeging',
					'tussenvoegsel',
					'geboortedatum',
					'geboorteplaats',
					'aktief',
					'in_dienst',
					'indienst_sinds',
					'is_onderaannemer',
					'onderaannemer_sinds',
					'vevaldatum_vca',
					'vervaldatum_glasmonteur',
					'vervaldatum_glaszetter'
				);
				$validator = Validator::make(
					$params,
					[
						'company_ids' => $rule . '|array',
						'achternaam' => $rule,
						'initialen' => $rule,
						'toevoeging' => $rule,
						'tussenvoegsel' => $rule,
						'geboortedatum' => $rule,
						'geboorteplaats' => $rule,
						'aktief' => $rule,
						'in_dienst' => $rule,
						'indienst_sinds' => $rule,
						'is_onderaannemer' => $rule,
						'onderaannemer_sinds' => $rule,
						//'vevaldatum_vca' => $rule,
						//'vervaldatum_glasmonteur' => $rule,
						//'vervaldatum_glaszetter' => $rule,
					],[
						'required' => 'Het veld :attribute is verplicht.'
					]
				);
				if ($validator->fails()) {
					return response()->json(['errors' => $this->valid($validator)]);
				}
				DB::beginTransaction();
				try {
					unset($params['company_ids']);
					$params['geboortedatum'] = date('Y-m-d', strtotime($params['geboortedatum']));
					$params['vervaldatum_glasmonteur'] = date('Y-m-d', strtotime($params['vervaldatum_glasmonteur']));
					$params['vervaldatum_glaszetter'] = date('Y-m-d', strtotime($params['vervaldatum_glaszetter']));
					$params['vevaldatum_vca'] = date('Y-m-d', strtotime($params['vevaldatum_vca']));
					$params['onderaannemer_sinds'] = date('Y-m-d', strtotime($params['onderaannemer_sinds']));
					$params['indienst_sinds'] = date('Y-m-d', strtotime($params['indienst_sinds']));
					$employee = Employee::create($params);
					foreach($request->company_ids as $company) {
						$employee->companies()->attach($company);
					}
					
					DB::commit();
				} catch (Exception $e) {
					DB::rollback();
					return response()->json(['error' => $e->getMessage()]);
				} catch (Throwable $e) {
					DB::rollback();
					return response()->json(['error' => $e->getMessage()]);
				}
				return response()->json(['success' => __('Data Added successfully.')]);
			}
		}
		return response()->json(['success' => __('You are not authorized')]);
	}
	public function destroy($id)
	{
		if (!env('USER_VERIFIED')) {
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}
		$logged_user = auth()->user();
		if ($logged_user->can('modify-details-employee')) {
			DB::beginTransaction();
			try {
				Employee::whereId($id)->delete();
				$this->unlink($id);
				DB::commit();
			} catch (Exception $e) {
				DB::rollback();
				return response()->json(['error' => $e->getMessage()]);
			} catch (Throwable $e) {
				DB::rollback();
				return response()->json(['error' => $e->getMessage()]);
			}
			return response()->json(['success' => __('Data is successfully deleted')]);
		}
		return response()->json(['success' => __('You are not authorized')]);
	}
	public function unlink($employee)
	{
		// $user = User::findOrFail($employee);
		// $file_path = $user->profile_photo;
		// if ($file_path) {
		// 	$file_path = public_path('uploads/profile_photos/' . $file_path);
		// 	if (file_exists($file_path)) {
		// 		unlink($file_path);
		// 	}
		// }
	}
	public function delete_by_selection(Request $request)
	{
		if (!env('USER_VERIFIED')) {
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}
		$logged_user = auth()->user();
		if ($logged_user->can('modify-details-employee')) {
			$employee_id = $request['employeeIdArray'];
			Employee::whereIn('id', $employee_id)->delete();
			
			return response()->json(['success' => __('Data is successfully deleted')]);
		}
		
		return response()->json(['success' => __('You are not authorized')]);
	}
	public function infoUpdate(Request $request, $employee)
	{
		$logged_user = auth()->user();
		if ($logged_user->can('modify-details-employee')) {
			if (request()->ajax()) {
				$rule = 'required';
				$params = $request->only(
					'company_ids',
					'achternaam',
					'initialen',
					'toevoeging',
					'tussenvoegsel',
					'geboortedatum',
					'geboorteplaats',
					'aktief',
					'in_dienst',
					'indienst_sinds',
					'is_onderaannemer',
					'onderaannemer_sinds',
					'vevaldatum_vca',
					'vervaldatum_glasmonteur',
					'vervaldatum_glaszetter'
				);
				$validator = Validator::make(
					$params,
					[
						'company_ids' => $rule,
						'achternaam' => $rule,
						'initialen' => $rule,
						'toevoeging' => $rule,
						'tussenvoegsel' => $rule,
						'geboortedatum' => $rule,
						'geboorteplaats' => $rule,
						'aktief' => $rule,
						'in_dienst' => $rule,
						'indienst_sinds' => $rule,
						'is_onderaannemer' => $rule,
						'onderaannemer_sinds' => $rule,
						'vevaldatum_vca' => $rule,
						'vervaldatum_glasmonteur' => $rule,
						'vervaldatum_glaszetter' => $rule,
					]
				);
				if ($validator->fails()) {
					return response()->json(['errors' => $this->valid($validator)]);
				}
				DB::beginTransaction();
				try {
					unset($params['company_ids']);
					$employee = Employee::find($employee);
					$params['geboortedatum'] = date('Y-m-d', strtotime($params['geboortedatum']));
					$params['vervaldatum_glasmonteur'] = date('Y-m-d', strtotime($params['vervaldatum_glasmonteur']));
					$params['vervaldatum_glaszetter'] = date('Y-m-d', strtotime($params['vervaldatum_glaszetter']));
					$params['vevaldatum_vca'] = date('Y-m-d', strtotime($params['vevaldatum_vca']));
					$params['onderaannemer_sinds'] = date('Y-m-d', strtotime($params['onderaannemer_sinds']));
					$params['indienst_sinds'] = date('Y-m-d', strtotime($params['indienst_sinds']));
					$employee->update($params);
					$employee->companies()->detach();
					foreach($request->company_ids as $company) {
						$employee->companies()->attach($company);
					}
					DB::commit();
				} catch (Exception $e) {
					DB::rollback();
					return response()->json(['error' => $e->getMessage()]);
				} catch (Throwable $e) {
					DB::rollback();
					return response()->json(['error' => $e->getMessage()]);
				}
				return response()->json(['success' => __('Data Added successfully.')]);
			}
		}
		return response()->json(['success' => __('You are not authorized')]);
	}
	public function socialProfileShow(Employee $employee)
	{
		return view('employee.social_profile.index', compact('employee'));
	}
	public function storeSocialInfo(Request $request, $employee)
	{
		$logged_user = auth()->user();
		if ($logged_user->can('modify-details-employee') || $logged_user->id == $employee) {
			$data = [];
			$data['fb_id'] = $request->fb_id;
			$data['twitter_id'] = $request->twitter_id;
			$data['linkedIn_id'] = $request->linkedIn_id;
			$data['whatsapp_id'] = $request->whatsapp_id;
			$data['skype_id'] = $request->skype_id;
			Employee::whereId($employee)->update($data);
			return response()->json(['success' => __('Data is successfully updated')]);
		}
		return response()->json(['success' => __('You are not authorized')]);
	}
	public function indexProfilePicture(Employee $employee)
	{
		$logged_user = auth()->user();
		if ($logged_user->can('modify-details-employee')) {
			return view('employee.profile_picture.index', compact('employee'));
		}
		return response()->json(['success' => __('You are not authorized')]);
	}
	public function storeProfilePicture(Request $request, $employee)
	{
		$logged_user = auth()->user();
		if ($logged_user->can('modify-details-employee') || $logged_user->id == $employee) {
			$data = [];
			$photo = $request->profile_photo;
			$file_name = null;
			if (isset($photo)) {
				$new_user = $request->employee_username;
				if ($photo->isValid()) {
					$file_name = preg_replace('/\s+/', '', $new_user) . '_' . time() . '.' . $photo->getClientOriginalExtension();
					$photo->storeAs('profile_photos', $file_name);
					$data['profile_photo'] = $file_name;
				}
			}
			$this->unlink($employee);
			User::whereId($employee)->update($data);
			return response()->json(['success' => 'Data is successfully updated', 'profile_picture' => $file_name]);
		}
		return response()->json(['success' => __('You are not authorized')]);
	}
	public function setSalary(Employee $employee)
	{
		$logged_user = auth()->user();
		if ($logged_user->can('modify-details-employee')) {
			return view('employee.salary.index', compact('employee'));
		}
		return response()->json(['success' => __('You are not authorized')]);
	}
	public function storeSalary(Request $request, $employee)
	{
		$logged_user = auth()->user();
		if ($logged_user->can('modify-details-employee')) {
			$validator = Validator::make(
				$request->only(
					'payslip_type',
					'basic_salary'
				),
				[
					'basic_salary' => 'required|numeric',
					'payslip_type' => 'required',
				]
			);
			if ($validator->fails()) {
				return response()->json(['errors' => $this->valid($validator)]);
			}
			DB::beginTransaction();
			try {
				Employee::updateOrCreate(['id' => $employee], [
					'payslip_type' => $request->payslip_type,
					'basic_salary' => $request->basic_salary
				]);
				DB::commit();
			} catch (Exception $e) {
				DB::rollback();
				return response()->json(['error' => $e->getMessage()]);
			} catch (Throwable $e) {
				DB::rollback();
				return response()->json(['error' => $e->getMessage()]);
			}
			return response()->json(['success' => __('Data Added successfully.')]);
		}
		return response()->json(['error' => __('You are not authorized')]);
	}
	public function employeesPensionUpdate(Request $request, $employee)
	{
		//return response()->json('ok');
		$logged_user = auth()->user();
		if ($logged_user->can('modify-details-employee')) {
			$validator = Validator::make(
				$request->only('pension_type', 'pension_amount'),
				[
					'pension_type'  => 'required',
					'pension_amount' => 'required|numeric',
				]
			);
			if ($validator->fails()) {
				return response()->json(['errors' => $this->valid($validator)]);
			}
			DB::beginTransaction();
			try {
				Employee::updateOrCreate(['id' => $employee], [
					'pension_type' => $request->pension_type,
					'pension_amount' => $request->pension_amount
				]);
				DB::commit();
			} catch (Exception $e) {
				DB::rollback();
				return response()->json(['error' => $e->getMessage()]);
			} catch (Throwable $e) {
				DB::rollback();
				return response()->json(['error' => $e->getMessage()]);
			}
			return response()->json(['success' => __('Data Added successfully.')]);
		}
		return response()->json(['success' => __('You are not authorized')]);
	}
	public function import()
	{
		if (auth()->user()->can('import-employee')) {
			return view('employee.import');
		}
		return abort(404, __('You are not authorized'));
	}
	public function importPost()
	{
		try {
			Excel::import(new EmployeeImport(), request()->file('file'));
		} catch (ValidationException $e) {
			$failures = $e->failures();
			return view('employee.importError', compact('failures'));
		}
		$this->setSuccessMessage(__('Imported Successfully'));
		return back();
	}
	public function certificationImport()
	{
		if (auth()->user()->can('import-employee')) {
			return view('employee.certification-import');
		}
		return abort(404, __('You are not authorized'));
	}
	public function certificationImportPost()
	{
		try {
			Excel::import(new CertificationImport, request()->file('file'));
		} catch (ValidationException $e) {
			$failures = $e->failures();
			return view('employee.importError', compact('failures'));
		}
		$this->setSuccessMessage(__('Imported Successfully'));
		return back();
	}
	public function employeePDF($id)
	{
		$employee = Employee::with('user:id,profile_photo,username', 'company:id,organisatie', 'department:id,department_name', 'designation:id,designation_name', 'officeShift:id,shift_name', 'role:id,name')
			->where('id', $id)
			->first()
			->toArray();
		PDF::setOptions(['dpi' => 10, 'defaultFont' => 'sans-serif', 'tempDir' => storage_path('temp')]);
		$pdf = PDF::loadView('employee.pdf', $employee);
		return $pdf->stream();
	}
	/**
	 * @param mixed $id
	 * @param mixed $certificationId
	 * 
	 * @return mixed
	 */
	public function glasMonteren($id)
	{
		\Carbon\Carbon::setLocale('nl');
		$certification = Certification::whereId($id)->first();
		$pdf = PDF::loadView('employee.pdf.glas_monteren', ['employee' => $certification->employee, 'certification' => $certification->toArray()]);
		// return view('employee.pdf.glas_monteren', ['employee' => $certification->employee, 'certification' => $certification->toArray()]);
		return $pdf->download(__('GLAS MONTEREN') . ".pdf");
	}
	
	/**
	 * @param mixed $id
	 * 
	 * @return mixed
	 */
	public function glaszetten($id)
	{
		\Carbon\Carbon::setLocale('nl');
		$certification = Certification::find($id);
		$pdf = PDF::loadView('employee.pdf.glaszetten', ['employee' => $certification->employee, 'certification' => $certification->toArray()]);
		// return view('employee.pdf.glaszetten', ['employee' => $certification->employee, 'certification' => $certification->toArray()]);
		
		// return $pdf->stream(__('GLASZETTEN') . ".pdf");
		return $pdf->download(__('GLASZETTEN') . ".pdf");
	}
	public function klantenImporteren()
	{
		return view('employee.imports/klanten-importeren');
	}
	
	public function postKlantenImporteren()
	{
		try {
			Excel::import(new KlantenImporteren(), request()->file('file'));
		} catch (Exception $e) {
			return Redirect::route('klanten.importeren')->withErrors(['errors' => $e->getMessage()]);
		}
		$this->setSuccessMessage(__('Imported Successfully'));
		return back();
	}
}