<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Attendance;
use App\Award;
use App\GeneralSetting;
use App\Client;
use App\Company;
use App\DocumentType;
use App\Employee;
use App\EmployeeProject;
use App\EmployeeTask;
use App\EmployeeTicket;
use App\Holiday;
use App\IpSetting;
use App\LeaveType;
use App\QualificationEducationLevel;
use App\QualificationLanguage;
use App\QualificationSkill;
use App\SalaryBasic;
use App\status;
use App\SupportTicket;
use App\Trainer;
use App\TrainingType;
use App\TravelType;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;
use App\Course;

class DashboardController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware(['auth']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return Renderable
	 */
	public function index(Request $request)
	{
		$courses = Course::whereNotNull('email')
			->whereIn('type', [Course::TYPE_OPLEIDINGSVERGOEDING, Course::TYPE_VERLETVERGOEDING])
			->whereIsApproved(Course::IS_WAIT_CONFIRM)
			->orderBy('created_at', 'desc')
			->get();

		if (request()->ajax()) {
			return  datatables()->of($courses)
				->setRowId(function ($row) {
					return $row->id;
				})
				->addColumn('email', function ($data) {
					return $data->email;
				})
				->addColumn('created_at', function ($data) {
					return formatDate($data->created_at);
				})
				->addColumn('iban_nummer', function ($data) {
					return @json_decode($data->content, true)['iban_nummer'] ?? '';
				})
				->addColumn('is_watched', function ($data) {
					return Course::APPROVED_LIST[$data->is_approved];
				})
				->addColumn('type', function ($data) {
					$type = "";
					switch ($data->type) {
						case (Course::TYPE_VERLETVERGOEDING):
							$type = __('Verletvergoeding');
							break;
						case (Course::TYPE_OPLEIDINGSVERGOEDING):
							$type = __('Opleidingsvergoeding');
							break;
						case (Course::TYPE_LOONSOMOPGAVE):
							$type = __('Loonsomopgave');
							break;
					}

					return $type;
				})
				->addColumn('is_approved', function ($data) {
					return @__(Course::APPROVED_LIST[$data->is_approved]);
				})
				->addColumn('amount_request', function ($data) {
					return getNumberFormat($data->amount_request);
				})
				->addColumn('action', function ($data) {
					$button = '';
					$button .= '<a href="' . route('course.show', ['id' => $data->id]) . '"  class="edit btn btn-info btn-sm"><i class="dripicons-preview"></i></button></a> ';
					$button .= '<a href="' . route('course.edit', ['id' => $data->id]) . '"  class="edit btn btn-primary btn-sm"><i class="dripicons-document-edit"></i></button></a>';

					return $button;
				})
				->make(true);
		}

		return view('dashboard.admin_dashboard', compact('courses'));
	}

	public function profile()
	{
		$user = auth()->user();

		$employee = Employee::find($user->id);

		if (!$employee) {
			if ($user->role_users_id == 3) {
				return view('profile.client_profile', compact('user'));
			}

			return view('profile.user_profile', compact('user'));
		} else {
			$statuses = status::select('id', 'status_title')->get();

			$countries = DB::table('countries')->select('id', 'name')->get();
			$document_types = DocumentType::select('id', 'document_type')->get();

			$education_levels = QualificationEducationLevel::select('id', 'name')->get();
			$language_skills = QualificationLanguage::select('id', 'name')->get();
			$general_skills = QualificationSkill::select('id', 'name')->get();

			$salary_basics = SalaryBasic::where('employee_id', $employee->id)
				->orderByRaw('DATE_FORMAT(first_date, "%y-%m")')
				->get();

			return view('profile.user_profile', compact('user'));
		}
	}

	public function profile_update(Request $request, $id)
	{

		if (!env('USER_VERIFIED')) {
			return redirect()->back()->with('msg', 'This feature is disabled for demo!');
		}
		$user = User::findOrFail($id);

		$validator = Validator::make(
			$request->all(),
			[
				'first_name' => 'required|unique:users,first_name,' . $id,
				'last_name' => 'required|unique:users,last_name,' . $id,
				'username' => 'required|unique:users,username,' . $id,
				'email' => 'required|email|unique:users,email,' . $id,
				'contact_no' => 'required|unique:users,contact_no,' . $id,
				'profile_photo' => 'nullable|image|max:10240|mimes:jpeg,png,jpg,gif',
			]
		);


		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$photo = $request->profile_photo;


		if (isset($photo)) {
			$new_user = $request->username;
			if ($photo->isValid()) {
				$file_name = preg_replace('/\s+/', '', $new_user) . '_' . time() . '.' . $photo->getClientOriginalExtension();
				$photo->storeAs('profile_photos', $file_name);
				$user->profile_photo = $file_name;
			}
		}

		$username = strtolower(trim($request->username));
		$contact_no = $request->contact_no;
		$email = strtolower(trim($request->email));

		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->username = $username;
		$user->contact_no = $contact_no;
		$user->email = $email;

		$user->save();

		if ($user->role_users_id == 3) {
			Client::whereId($user->id)->update([
				'username' => $username, 'contact_no' => $contact_no,
				'email' => $email
			]);
			$this->setSuccessMessage(__('User Info Updated'));

			return redirect()->route('clientProfile');
		}

		$this->setSuccessMessage(__('User Info Updated'));

		return redirect()->route('profile');
	}

	public function employeeProfileUpdate(Request $request, $id)
	{

		$validator = Validator::make(
			$request->only(
				'first_name',
				'last_name',
				'email',
				'contact_no',
				'gender'
			),
			[
				'first_name' => 'required',
				'last_name' => 'required',
				'email' => 'required|email|unique:users,email,' . $id,
				'contact_no' => 'required|numeric|unique:users,contact_no,' . $id,
				'gender' => 'required',
			]
		);


		if ($validator->fails()) {
			return response()->json(['errors' => $this->valid($validator)]);
		}

		$data = [];
		$data['first_name'] = $request->first_name;
		$data['last_name'] = $request->last_name;
		$data['gender'] = $request->gender;
		$data['marital_status'] = $request->marital_status;

		$data['address'] = $request->address;
		$data['city'] = $request->city;
		$data['state'] = $request->state;
		$data['country'] = $request->country;
		$data['zip_code'] = $request->zip_code;


		$data['email'] = strtolower(trim($request->email));
		$data['contact_no'] = $request->contact_no;


		$user = [];

		$user['email'] = strtolower(trim($request->email));
		$user['contact_no'] = $request->contact_no;


		DB::beginTransaction();
		try {
			User::whereId($id)->update($user);

			employee::whereId($id)->update($data);

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			return response()->json(['error' =>  $e->getMessage()]);
		} catch (Throwable $e) {
			DB::rollback();
			return response()->json(['error' => $e->getMessage()]);
		}

		return response()->json(['success' => __('Data Added successfully.')]);
	}


	public function change_password(Request $request, $id)
	{

		if (!env('USER_VERIFIED')) {
			return redirect()->back()->with('msg', 'This feature is disabled for demo!');
		}

		$user = User::findOrFail($id);

		$validator = Validator::make(
			$request->all(),
			[
				'password' => 'required|min:4|confirmed',
			]
		);


		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}


		$user->password = bcrypt($request->password);
		$user->save();

		$this->setSuccessMessage(__('Password has been changed'));

		return redirect('login')->with(Auth::logout());
	}

	public function logout()
	{
		$this->setSuccessMessage(__('Password has been changed'));

		return redirect('login')->with(Auth::logout());
	}


	protected function getIp($ip)
	{
		$data  = [];
		$data  = str_split($ip);
		$length = strlen($ip) . '<br>';

		$count = 0;
		$get_ip = "";
		for ($i = 0; $i < $length; $i++) {
			if ($data[$i] == '.') {
				$count++;
			}
			$get_ip .= $data[$i];
			if ($count == 3) {
				break;
			}
		}

		return $get_ip;
	}


	public function employeeDashboard(Request $request)
	{
		$user = auth()->user();
		$employee = Employee::with('department:id,department_name', 'officeShift')->findOrFail($user->id);
		$current_day_in = strtolower(Carbon::now()->format('l')) . '_in';
		$current_day_out = strtolower(Carbon::now()->format('l')) . '_out';

		$shift_in = $employee->officeShift->$current_day_in;
		$shift_out = $employee->officeShift->$current_day_out;
		$shift_name = $employee->officeShift->shift_name;

		$announcements = Announcement::where('start_date', '<=', now()->format('Y-m-d'))
			->where('end_date', '>=', now()->format('Y-m-d'))->where('is_notify', 1)->select('id', 'title', 'summary')->latest()->take(3)->get();

		$employee_award_count = Award::where('employee_id', $user->id)->count();

		$holidays = Holiday::where('is_publish', 1)
			->where('end_date', '>=', now()->format('Y-m-d'))
			->where('company_id', $employee->company_id)
			->select('id', 'event_name', 'start_date', 'end_date')->latest()->take(3)->get();

		$leave_types = LeaveType::select('id', 'leave_type', 'allocated_day')->get();
		$travel_types = TravelType::select('id', 'arrangement_type')->get();


		$assigned_projects = EmployeeProject::with(['assignedProjects' => function ($query) use ($employee) {
			$query->where('project_status', '!=', 'completed')->select('id', 'title', 'project_status');
		},])
			->where('employee_id', $employee->id)->get();
		// $assigned_projects_count = $assigned_projects->count();
		$assigned_projects_count = 0;
		foreach ($assigned_projects as $task) {
			if (count($task->assignedProjects) != 0) {
				$assigned_projects_count++;
			}
		}


		$assigned_tasks = EmployeeTask::with(['assignedTasks' => function ($query) use ($employee) {
			$query->where('task_status', '!=', 'completed')->select('id', 'task_name', 'task_status');
		},])
			->where('employee_id', $employee->id)->get();

		// $assigned_tasks_count = $assigned_tasks->count();
		$assigned_tasks_count = 0;
		foreach ($assigned_tasks as $task) {
			if (count($task->assignedTasks) != 0) {
				$assigned_tasks_count++;
			}
		}


		$assigned_tickets = EmployeeTicket::with(['assignedTickets' => function ($query) use ($employee) {
			$query->where('ticket_status', '=', 'open')->select('id', 'subject', 'ticket_code', 'ticket_status');
		},])
			->where('employee_id', $employee->id)->get();

		//$assigned_tickets_count = $assigned_tickets->count();
		$assigned_tickets_count = 0;
		foreach ($assigned_tickets as $ticket) {
			if (count($ticket->assignedTickets) != 0) {
				$assigned_tickets_count++;
			}
		}



		//checking if emoloyee has attendance on current day
		$employee_attendance = Attendance::where('attendance_date', now()->format('Y-m-d'))
			->where('employee_id', $employee->id)->orderBy('id', 'desc')->first() ?? null;

		//IP Check

		$ip_setting = IpSetting::get();

		if (count($ip_setting) == 0) {
			$ipCheck =  false;
		} else {
			foreach ($ip_setting as $key => $value) {
				$db_ip = $this->getIp($value->ip_address);

				$client_ip = $this->getIp($request->ip());

				if ($db_ip == $client_ip) {
					$ipCheck =  true;
					break;
				} else {
					$ipCheck =  false;
				}
			}
		}
		return view('dashboard.employee_dashboard', compact(
			'user',
			'employee',
			'employee_attendance',
			'shift_in',
			'shift_out',
			'shift_name',
			'announcements',
			'employee_award_count',
			'holidays',
			'leave_types',
			'travel_types',
			'assigned_projects',
			'assigned_projects_count',
			'assigned_tasks',
			'assigned_tasks_count',
			'assigned_tickets',
			'assigned_tickets_count',
			'ipCheck'
		));
	}



	public function clientDashboard()
	{
		$user = auth()->user();
		$client = Client::with('invoices', 'projects')->findOrFail($user->id);
		$courses = Course::whereUserId($user->id)->whereIsApproved(Course::IS_APPROVED_YES)->get();
		$checkSubmitLoomsom = Course::whereUserId($user->id)
			->whereType(Course::TYPE_LOONSOMOPGAVE)
			->whereYear('created_at', now()->year)
			->exists();

		return view('dashboard.client_dashboard', compact(
			'user',
			'client',
			'checkSubmitLoomsom',
		));
	}

	public function clientProfile()
	{
		$user = auth()->user();
		if ($user->role_users_id == 3) {
			return view('profile.client_profile', compact('user'));
		}

		return redirect('profile');
	}
}
