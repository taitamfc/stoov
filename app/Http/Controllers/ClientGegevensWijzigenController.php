<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GegevensWijzigen;
use App\Mail\GegevensWijzigenSendMail;
use App\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Mail;

class ClientGegevensWijzigenController extends Controller
{
	public function index(Request $request)
	{
		$user = auth()->user();
		$gegevensWijzigens = GegevensWijzigen::when($user->role_users_id && $user->role_users_id == User::CLIENT, function ($q) use ($user) {
			$q->whereClientId($user->client->id);
		})
			->get();

		if (request()->ajax()) {
			return  datatables()->of($gegevensWijzigens)
				->setRowId(function ($row) {
					return $row->id;
				})
				->make(true);
		}

		return view('client.gegevens_wijzigens', compact('gegevensWijzigens'));
	}

	public function store(Request $request)
	{
			$params = $request->only(
				'relatienummer',
				'naam_bedrijf',
				'uw_naam',
				'emailadres'
			);
			$user = auth()->user();
			$params['client_id'] = $user->client->id;

			$validator = Validator::make(
				$params,
				[
					'relatienummer' => 'required',
					'naam_bedrijf' => 'required',
					'emailadres' => 'required|email',
					'uw_naam' => 'required'
				],
				[
					'relatienummer.required' => 'Het veld relatienummer mag niet leeg zijn',
					'naam_bedrijf.required' => 'Het veld naam_bedrijf mag niet leeg zijn',
					'emailadres.required' => 'Het veld emailadres mag niet leeg zijn',
					'emailadres.email' => 'Het veld emailadres is niet in het juiste formaat',
					'uw_naam.required' => 'Het veld uw_naam mag niet leeg zijn'
				]
			);

			if ($validator->fails()) {
				return response()->json(['errors' => $this->valid($validator)]);
			}
			try {
				$data = GegevensWijzigen::create($params);
				Mail::to(config('mail.from.address'))->send(new GegevensWijzigenSendMail($data->toArray()));

				return response()->json(['success' => __('Data Added successfully.')]);
			} catch (Exception $e) {
				return response()->json(['error' => $e->getMessage()]);

			}
	}
}
