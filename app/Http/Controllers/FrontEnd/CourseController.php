<?php

namespace App\Http\Controllers\FrontEnd;

use App\Course;
use App\Http\Requests\EmailContact\PostFormVerletvergoedingRequest;
use App\Http\Requests\EmailContact\PostFormLoonsomopgaveRequest;
use App\Http\Requests\EmailContact\PostFormOpleidingsvergoedingRequest;
use Illuminate\Http\Request;
use Exception;
use App\Services\CourseService;
use App\Employee;
use App\Package;

class CourseController
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

	public function getContactInjuryCompensation()
	{
		try {
			$courses = Package::where('is_active', true)
			->where('price','>',0)
			->get();
			$compensationAmounts = config('course.compensation_amount');
			$client = auth()->user()->client;
			$employees = Employee::whereHas('companies', function ($q) use ($client) {
				$q->whereId($client->company_id);
			})
				->get();

			return view('client.verletvergoeding', compact('compensationAmounts', 'courses', 'employees', 'client'));
		} catch (Exception $e) {
			return abort('403', __('You are not authorized'));
		}
	}

	public function getContactTrainingGrant()
	{
		try {
			$courses = Package::where('is_active', true)
			->where('percentage','>',0)
			->get();
			$client = auth()->user()->client;

			return view('client.opleidingsvergoeding', compact('client', 'courses'));
		} catch (Exception $e) {
			return abort('403', __('You are not authorized'));
		}
	}

	/**
	 * Post contact Opleidingsvergoeding
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getLoonsomopgave()
	{
		try {
			$client = auth()->user()->client;
			$checkSubmitLoomsom = Course::whereUserId($client->id)
				->whereType(Course::TYPE_LOONSOMOPGAVE)
				->whereYear('created_at', date('Y'))
				->first();

			if ($checkSubmitLoomsom) {
				return redirect()->route('client.ClientDashboard');
			}

			return view('client.loonsomopgave', compact('client'));
		} catch (Exception $e) {
			return abort('403', __('You are not authorized'));
		}
	}

	/**
	 * Post contact Verletvergoeding
	 *
	 * @param PostFormVerletvergoedingRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function postFormVerletvergoeding(PostFormVerletvergoedingRequest $request)
	{
		try {
			$loggedUser = auth()->user();
			$this->courseService->postFormVerletvergoeding($request, $loggedUser);

			return response()->json(['success' => __('Data is successfully updated'), 'data' => []]);
		} catch (Exception $e) {
			return response()->json(['error' => $e->getMessage()]);
		}
	}

	/**
	 * Post contact Opleidingsvergoeding
	 *
	 * @param PostFormOpleidingsvergoedingRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postFormOpleidingsvergoeding(PostFormOpleidingsvergoedingRequest $request)
	{
		try {
			$loggedUser = auth()->user();
			$this->courseService->postFormOpleidingsvergoeding($request, $loggedUser);

			return response()->json(['success' => __('Data is successfully updated'), 'data' => []]);
		} catch (Exception $e) {
			return response()->json(['error' => $e->getMessage()]);
		}
	}

	/**
	 * Post contact Loonsomopgave
	 *
	 * @param postFormLoonsomopgaveRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function postFormLoonsomopgave(postFormLoonsomopgaveRequest $request)
	{
		try {
			$loggedUser = auth()->user();
			$this->courseService->postFormLoonsomopgave($request, $loggedUser);

			return response()->json(['success' => __('Data is successfully updated'), 'data' => []]);
		} catch (Exception $e) {
			return response()->json(['error' => $e->getMessage()]);
		}
	}
}
