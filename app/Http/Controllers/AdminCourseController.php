<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Client;
use App\Course;
use App\EmailSetting;
use App\Employee;
use App\Imports\LoonsomopgaveImporteren;
use App\Imports\OpleidingsvergoedingImporteren;
use App\Imports\VerletvergoedingImporteren;
use Illuminate\Http\Request;
use App\Jobs\ContactSendMailJob;
use App\Mail\ClientRegistersForTheCourse;
use App\Package;
use App\Services\CourseService;
use App\User;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class AdminCourseController extends Controller
{
	protected $courseService;

	/**
	 * Create a new controller instance.
	 *
	 * @param CourseService $courseService
	 */
	public function __construct(CourseService $courseService)
	{
		$this->courseService = $courseService;
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * 
	 * @return mixed
	 */
	public function index(Request $request)
	{
		$user = auth()->user();
		$courses = Course::whereNotNull('email')
			->whereIn('type', [Course::TYPE_VERLETVERGOEDING, Course::TYPE_OPLEIDINGSVERGOEDING])
			->when(@$user->role_users_id == User::CLIENT, function ($q) use ($user) {
				$q->whereUserId($user->id);
			})
			->when(isset($request->type), function ($q) use ($request) {
				$q->whereType($request->type);
			})
			->when(isset($request->is_approved), function ($q) use ($request) {
				$q->whereIsApproved($request->is_approved);
			})
			->when(isset($request->start_date) || isset($request->end_date), function ($q) use ($request) {
				$startDate = $request->start_date ? date($request->start_date) : null;
				$endDate = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : null;
				if ($startDate && $endDate)
					return $q->whereBetween('created_at', [$startDate, $endDate]);
				if ($startDate && !$endDate)
					return $q->whereDate('created_at', '>=', $startDate);
				if (!$startDate && $endDate)
					return $q->whereDate('created_at', '<=', $endDate);
			})
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

		return view('course.ingezonden_formulieren', compact('courses'));
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * 
	 * @return mixed
	 */
	public function loonsomopgaves(Request $request)
	{
		$user = auth()->user();
		$courses = Course::whereNotNull('email')
			->whereType(Course::TYPE_LOONSOMOPGAVE)
			->when(@$user->role_users_id == User::CLIENT, function ($q) use ($user) {
				$q->whereUserId($user->id);
			})
			->when(isset($request->type), function ($q) use ($request) {
				$q->whereType($request->type);
			})
			->when(isset($request->is_approved), function ($q) use ($request) {
				$q->whereIsApproved($request->is_approved);
			})
			->when(isset($request->start_date) || isset($request->end_date), function ($q) use ($request) {
				$startDate = $request->start_date ? date($request->start_date) : null;
				$endDate = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : null;
				if ($startDate && $endDate)
					return $q->whereBetween('created_at', [$startDate, $endDate]);
				if ($startDate && !$endDate)
					return $q->whereDate('created_at', '>=', $startDate);
				if (!$startDate && $endDate)
					return $q->whereDate('created_at', '<=', $endDate);
			})
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
				->addColumn('company_name', function ($data) {
					return @$data->company->organisatie ?? '';
				})
				->addColumn('company_name', function ($data) {
					return @$data->company->organisatie ?? '';
				})
				->addColumn('company_plaats', function ($data) {
					return @$data->company->plaats ?? '';
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
					$button .= '<a href="' . route('loonsomopgaves.show', ['id' => $data->id]) . '"  class="edit btn btn-info btn-sm"><i class="dripicons-preview"></i></button></a> ';
					$button .= '<a href="' . route('loonsomopgaves.edit', ['id' => $data->id]) . '"  class="edit btn btn-primary btn-sm"><i class="dripicons-document-edit"></i></button></a>';

					return $button;
				})
				->make(true);
		}

		return view('course.loonsomopgaves', compact('courses'));
	}


	public function sendMails(Request $request)
	{
		$admin = auth()->user()->role_users_id == User::ADMINISTRATOR;

		if (!!$admin) {
			$ids = $request['employeeIdArray'];

			$mails = Course::whereNotNull('email')->whereIn('id', $ids)->get();

			foreach ($mails as $email) {
				dispatch(new ContactSendMailJob($email));
			}

			return response()->json(['success' => __('Send mail is success')]);
		}

		return response()->json(['success' => __('You are not authorized')]);
	}

	public function show($id)
	{
		$course = Course::where('id', $id)->whereIn('type', [
			Course::TYPE_VERLETVERGOEDING,
			Course::TYPE_OPLEIDINGSVERGOEDING
		])->first();

		$client = @Client::whereId($course->user_id)->first();
		$companyId = @$course->client->company_id ?? null;
		$fields = $course ? json_decode($course->content, true) : [];
		$remainingBudget = App::make(CourseService::class)->getRemainingBudget($companyId);
		$nameFields = [];
		if (in_array($course->type, [Course::TYPE_VERLETVERGOEDING])) {
			$fields = array_merge(['naam' => ($fields['first_name'] ?? null) . '' . ($fields['middle_name'] ?? null) . '' . ($fields['last_name'] ?? null)], $fields);
			$fields['naam'] = ($fields['first_name'] ?? null) . '' . ($fields['middle_name'] ?? null) . '' . ($fields['last_name'] ?? null);
			$fields['naam_cursus'] = @Package::whereId($fields['naam_cursus'])->first()->value ?? '';
			foreach ($fields['data_deelnemerslijst'] as $key => $item) {
				$fields['data_deelnemerslijst'][$key]['naam'] = ($fields['data_deelnemerslijst'][$key]['first_name'] ?? null) . '' . ($fields['data_deelnemerslijst'][$key]['middle_name'] ?? null) . '' . ($fields['data_deelnemerslijst'][$key]['last_name'] ?? null);
				$fields['data_deelnemerslijst'][$key]['datum'] = $fields['data_deelnemerslijst'][$key]['geboortedatum_werknemer_dd'] . '-' . $fields['data_deelnemerslijst'][$key]['geboortedatum_werknemer_mm'] . '-' . $fields['data_deelnemerslijst'][$key]['geboortedatum_werknemer_jjjj'];
				$fields['data_deelnemerslijst'][$key]['hoogte_verletvergoeding'] = $fields['data_deelnemerslijst'][$key]['hoogte_verletvergoeding'];
				$fields['data_deelnemerslijst'][$key] = unsets($fields['data_deelnemerslijst'][$key], ['first_name', 'middle_name', 'last_name', 'geboortedatum_werknemer_dd', 'geboortedatum_werknemer_mm', 'geboortedatum_werknemer_jjjj']);
			}
			$nameFields = Course::LIST_JSON_FIELDS_VERLETVERGOEDING;
		} elseif (in_array($course->type, [Course::TYPE_OPLEIDINGSVERGOEDING])) {
			$fields = array_merge(['naam' => ($fields['first_name'] ?? null) . '' . ($fields['middle_name'] ?? null) . '' . ($fields['last_name'] ?? null)], $fields);
			$fields['naam'] = implode(' ', [@$fields['first_name'], @$fields['middle_name'], @$fields['last_name']]);
			$fields['naam_cursus'] = @Package::whereId($fields['naam_cursus'])->first()->value ?? '';
			foreach ($fields['data_deelnemerslijst'] ?? [] as $key => $item) {
				$fields['data_deelnemerslijst'][$key]['naam'] = ($fields['data_deelnemerslijst'][$key]['first_name'] ?? null) . '' . ($fields['data_deelnemerslijst'][$key]['middle_name'] ?? null) . '' . ($fields['data_deelnemerslijst'][$key]['last_name'] ?? null);
				$fields['data_deelnemerslijst'][$key]['datum'] = $fields['data_deelnemerslijst'][$key]['geboortedatum_werknemer_dd'] . '-' . $fields['data_deelnemerslijst'][$key]['geboortedatum_werknemer_mm'] . '-' . $fields['data_deelnemerslijst'][$key]['geboortedatum_werknemer_jjjj'];
				$fields['data_deelnemerslijst'][$key] = unsets($fields['data_deelnemerslijst'][$key], ['first_name', 'middle_name', 'last_name', 'geboortedatum_werknemer_dd', 'geboortedatum_werknemer_mm', 'geboortedatum_werknemer_jjjj']);
			}
			$nameFields = Course::LIST_JSON_FIELDS_OPLEIDINGSVERGOEDING;
		}

		return view('course.ingezonden_formulieren_show', [
			'course' => $course,
			'fields' => $fields,
			'nameFields' => $nameFields,
			'remaining_budget' => $remainingBudget,
			'client' => $client
		]);
	}

	public function edit($id)
	{
		$course = Course::where('id', $id)->whereIn('type', [
			Course::TYPE_VERLETVERGOEDING,
			Course::TYPE_OPLEIDINGSVERGOEDING
		])->first();
		if(!$course) {
			return abort(404,__('Not found'));
		}
		$user = @User::whereId($course->user_id)->first();
		if ($course) $course->update(['is_watched' => true]);
		$fields = $course ? json_decode($course->content, true) : [];
		$courses = @Package::where('is_active', true)->get();
		$compensationAmounts = config('course.compensation_amount');
		$employees = @Employee::whereHas('companies', function ($q) use ($user) {
			$q->whereId($user->company_id);
		})
			->get();

		if ($course->type == Course::TYPE_VERLETVERGOEDING) {
			return view('course.verletvergoeding_edit', compact('id', 'course', 'fields', 'courses', 'compensationAmounts', 'employees'));
		} elseif ($course->type == Course::TYPE_OPLEIDINGSVERGOEDING) {
			return view('course.opleidingsvergoeding_edit', compact('id', 'course', 'fields', 'courses', 'compensationAmounts', 'employees'));
		}
	}

	public function update(Request $request, $id)
	{
		try {
			$course = Course::whereNotNull('email')->where('id', $id)->first();

			if ($course->type === Course::TYPE_VERLETVERGOEDING) {
				$this->courseService->postFormVerletvergoeding($request, null, $id);
			} elseif ($course->type === Course::TYPE_OPLEIDINGSVERGOEDING) {
				$this->courseService->postFormOpleidingsvergoeding($request, null, $id);
			} else {
				$this->courseService->postFormLoonsomopgave($request, null, $id);
			}
			return response()->json(['success' => __('Data is successfully updated'), 'data' => []]);
		} catch (Exception $e) {
			return response()->json(['error' => $e->getMessage()]);
		}
	}


	/**
	 * @param \Illuminate\Http\Request $request
	 * 
	 * @return mixed
	 */
	public function courseRequest(Request $request)
	{
		$templates = Client::whereNotNull('email')
			->whereHas('courses', function ($q) use ($request) {
				$q->whereType(Course::TYPE_VERLETVERGOEDING)
					->when(isset($request->year), function ($q) use ($request) {
						$q->whereYear('created_at', $request->year);
					})
					->when(empty($request->year), function ($q) {
						$q->whereYear('created_at', Carbon::now()->format('Y'));
					});
			})
			->with(['courses' => function ($q) use ($request) {
				$q->whereType(Course::TYPE_VERLETVERGOEDING)
					->when(isset($request->year), function ($q) use ($request) {
						$q->whereYear('created_at', $request->year);
					})
					->when(empty($request->year), function ($q) {
						$q->whereYear('created_at', Carbon::now()->format('Y'));
					});
			}])
			->get();
		if (request()->ajax()) {
			return  datatables()->of($templates)
				->setRowId(function ($row) {
					return $row->courses()->orderBy('created_at', 'desc')->first()->id ?? null;
				})
				->addColumn('naam', function ($data) {
					return $data->first_name . ' ' . $data->last_name;
				})
				->addColumn('organisatie', function ($data) {
					return @$data->company->organisatie ?? '';
				})
				->addColumn('year_sent', function ($data) {
					$status = "";
					if ($data->year_sent == Carbon::now()->format('Y')) {
						$status = __('Mail Sent');
					} else {
						$status = __('Mail Error');
					}

					return $status;
				})
				->make(true);
		}

		return view('course.course-request');
	}

	public function verletvergoedingImporteren()
	{
		return view('course.imports/verletvergoeding-importeren');
	}

	public function opleidingsvergoedingImporteren()
	{
		return view('course.imports/opleidingsvergoeding-importeren');
	}

	public function loonsomopgaveImporteren()
	{
		return view('course.imports/loonsomopgave-importeren');
	}

	public function postVerletvergoedingImporteren()
	{
		try {
			Excel::import(new VerletvergoedingImporteren(), request()->file('file'));
		} catch (Exception $e) {
			return Redirect::route('course.verletvergoeding-importeren')->withErrors(['errors' => $e->getMessage()]);
		}
		$this->setSuccessMessage(__('Imported Successfully'));
		return back();
	}

	public function postOpleidingsvergoedingImporteren()
	{
		try {
			Excel::import(new OpleidingsvergoedingImporteren(), request()->file('file'));
		} catch (Exception $e) {
			return Redirect::route('course.opleidingsvergoeding-importeren')->withErrors(['errors' => $e->getMessage()]);
		}
		$this->setSuccessMessage(__('Imported Successfully'));
		return back();
	}

	public function postLoonsomopgaveImporteren()
	{
		try {
			Excel::import(new LoonsomopgaveImporteren(), request()->file('file'));
		} catch (Exception $e) {
			return Redirect::route('course.loonsomopgave-importeren')->withErrors(['errors' => $e->getMessage()]);
		}
		$this->setSuccessMessage(__('Imported Successfully'));
		return back();
	}

	public function loonsomopgavesShow($id)
	{
		$course = Course::where('id', $id)->first();
		$client = @Client::whereId($course->user_id)->first();
		$companyId = @$course->client->company_id ?? null;
		$fields = $course ? json_decode($course->content, true) : [];
		$remainingBudget = App::make(CourseService::class)->getRemainingBudget($companyId);
		$nameFields = [];
		$fields['naam_cursus'] = @Package::whereId($fields['naam_cursus'])->first()->value ?? '';
		$nameFields = Course::LIST_JSON_FIELDS_LOONSOMOPGAVE;

		return view('course.loonsomopgaves_show', [
			'course' => $course,
			'fields' => $fields,
			'nameFields' => $nameFields,
			'remaining_budget' => $remainingBudget,
			'client' => $client
		]);
	}

	public function loonsomopgavesEdit($id)
	{
		$course = Course::where('id', $id)->first();
		$user = @User::whereId($course->user_id)->first();
		if ($course) $course->update(['is_watched' => true]);
		$fields = $course ? json_decode($course->content, true) : [];
		$courses = @Package::where('is_active', true)->get();
		$compensationAmounts = config('course.compensation_amount');
		$employees = @Employee::whereHas('companies', function ($q) use ($user) {
			$q->whereId($user->company_id);
		})
			->get();
			
		return view('course.loonsomopgave_edit', compact('id', 'course', 'fields', 'courses', 'compensationAmounts', 'employees'));
	}
}
