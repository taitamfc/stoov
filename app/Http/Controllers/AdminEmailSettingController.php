<?php

namespace App\Http\Controllers;

use App\EmailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class AdminEmailSettingController extends Controller
{
	public function index(Request $request)
	{
		$templates = EmailSetting::get();
		$verletvergoedingSuggest = [
			'all',
			'id',
			'naam_bedrijf',
			'iban_nummer',
			'voornaam',
			'tussenvoegsel',
			'achternaam',
			'email',
			'naam_cursus',
			'cursus_info',
			'informatie_over_het_opleidingsinstituut',
			'datum_cursus_van',
			'datum_tot',
			'deelnemersinfo_per_bestand',
			'deelnemerslijst',
			'employee',
			'amount_request',
			'client_name',
			'organisatie',
			'contact_no',
			'website',
			'company_email',
			"naam_werknemer_voorletters",
			"naam_werknemer_tussenvoegsel",
			"naam_werknemer_achternaammeisjesnaam",
			"geboortedatum_werknemer",
			"naam_werknemer_2_voorletters",
			"naam_werknemer_2_tussenvoegsel",
			"naam_werknemer_2_achternaammeisjesnaam",
			"geboortedatum_werknemer_2",
			"naam_werknemer_3_voorletters",
			"naam_werknemer_3_tussenvoegsel",
			"naam_werknemer_3_achternaammeisjesnaam",
			"geboortedatum_werknemer_3",
			"naam_werknemer_4_voorletters",
			"naam_werknemer_4_tussenvoegsel",
			"naam_werknemer_4_achternaammeisjesnaam",
			"geboortedatum_werknemer_4",
			"naam_werknemer_5_voorletters",
			"naam_werknemer_5_tussenvoegsel",
			"naam_werknemer_5_achternaammeisjesnaam",
			"geboortedatum_werknemer_5",
			"naam_werknemer_6_voorletters",
			"naam_werknemer_6_tussenvoegsel",
			"naam_werknemer_6_achternaammeisjesnaam",
			"geboortedatum_werknemer_6",
			"naam_werknemer_7_voorletters",
			"naam_werknemer_7_tussenvoegsel",
			"naam_werknemer_7_achternaammeisjesnaam",
			"geboortedatum_werknemer_7",
			"naam_werknemer_8_voorvoegsel",
			"naam_werknemer_8_voorletters",
			"naam_werknemer_8_tussenvoegsel",
			"naam_werknemer_8_achternaammeisjesnaam",
			"geboortedatum_werknemer_8",
			"naam_werknemer_9_voorletters",
			"naam_werknemer_9_tussenvoegsel",
			"naam_werknemer_9_achternaammeisjesnaam",
			"geboortedatum_werknemer_9",
			"naam_werknemer_10_voorletters",
			"naam_werknemer_10_tussenvoegsel",
			"naam_werknemer_10_achternaammeisjesnaam",
			"geboortedatum_werknemer_10",
		];

		$opleidingsvergoedingSuggest = [
			'all',
			'id',
			'naam_bedrijf',
			'iban_nummer',
			'voornaam',
			'tussenvoegsel',
			'achternaam',
			'email',
			'course',
			'naam_cursus',
			'cursus_info',
			'naam_opleidingsinstituut',
			'informatie_over_het_opleidingsinstituut',
			'datum_cursus_van',
			'datum_tot',
			'subsidiepercentage_dat_van_toepassing_is',
			'totaalbedrag_subsidie_aanvraag',
			'aard_van_de_cursus',
			'factuur',
			'certificaat',
			'deelnemers',
			'data_deelnemerslijst',
			'amount_request',
			'client_name',
			'organisatie',
			'contact_no',
			'website',
			'company_email',
			"naam_werknemer_voorletters",
			"naam_werknemer_tussenvoegsel",
			"naam_werknemer_achternaammeisjesnaam",
			"geboortedatum_werknemer",
			"naam_werknemer_2_voorletters",
			"naam_werknemer_2_tussenvoegsel",
			"naam_werknemer_2_achternaammeisjesnaam",
			"geboortedatum_werknemer_2",
			"naam_werknemer_3_voorletters",
			"naam_werknemer_3_tussenvoegsel",
			"naam_werknemer_3_achternaammeisjesnaam",
			"geboortedatum_werknemer_3",
			"naam_werknemer_4_voorletters",
			"naam_werknemer_4_tussenvoegsel",
			"naam_werknemer_4_achternaammeisjesnaam",
			"geboortedatum_werknemer_4",
			"naam_werknemer_5_voorletters",
			"naam_werknemer_5_tussenvoegsel",
			"naam_werknemer_5_achternaammeisjesnaam",
			"geboortedatum_werknemer_5",
			"naam_werknemer_6_voorletters",
			"naam_werknemer_6_tussenvoegsel",
			"naam_werknemer_6_achternaammeisjesnaam",
			"geboortedatum_werknemer_6",
			"naam_werknemer_7_voorletters",
			"naam_werknemer_7_tussenvoegsel",
			"naam_werknemer_7_achternaammeisjesnaam",
			"geboortedatum_werknemer_7",
			"naam_werknemer_8_voorvoegsel",
			"naam_werknemer_8_voorletters",
			"naam_werknemer_8_tussenvoegsel",
			"naam_werknemer_8_achternaammeisjesnaam",
			"geboortedatum_werknemer_8",
			"naam_werknemer_9_voorletters",
			"naam_werknemer_9_tussenvoegsel",
			"naam_werknemer_9_achternaammeisjesnaam",
			"geboortedatum_werknemer_9",
			"naam_werknemer_10_voorletters",
			"naam_werknemer_10_tussenvoegsel",
			"naam_werknemer_10_achternaammeisjesnaam",
			"geboortedatum_werknemer_10",
		];

		$loonsomopgaveSuggest = [
			'all',
			'id',
			'relatienummer',
			'naam_bedrijf',
			'uw_naam',
			'email',
			'telefoonnummer',
			'reden',
			'personeel_in_loondienst',
			'personeel_datum',
			'personeel_tot',
			'loonsom',
			'aantal_medewerkers',
			'toelichting_en_of_opmerkingen',
			'verklaring',
			'amount_request',
			'client_name',
			'organisatie',
			'contact_no',
			'website',
			'company_email',
		];

		if (request()->ajax()) {
			return  datatables()->of($templates)
				->setRowId(function ($row) {
					return $row->id;
				})
				->addColumn('subject', function ($data) {
					return $data->subject;
				})
				->addColumn('type', function ($data) {
					return EmailSetting::TYPE_NAMES_LIST[$data->type];
				})
				->addColumn('action', function ($data)
				{
					$button = '';
					if (!!auth()->user())
					{
						$button .= '<a type="button" data-id="' . $data->id . '" class="btn-edit btn btn-primary btn-sm" title="View Details"><i class="dripicons-preview"></i></button></a>';
						$button .= '&nbsp;&nbsp;&nbsp;';
						$button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="dripicons-trash"></i></button>';
						$button .= '&nbsp;&nbsp;&nbsp;';
					}
					return $button;
				})
				->make(true);
		}
		
		return view('email_setting.index', compact('verletvergoedingSuggest', 'opleidingsvergoedingSuggest', 'loonsomopgaveSuggest'));
	}


	public function store(Request $request)
	{
		$logged_user = auth()->user();

		if (!!$logged_user) {
			if (request()->ajax()) {
				$rule = 'required';
				$params = $request->only(
					'subject',
					'content',
					'admin_email',
					'button_text',
					'bcc_email',
					'cc_email',
					'type'
				);

				$validator = Validator::make(
					$params,
					[
						'subject' => $rule,
						'content' => $rule,
						'admin_email' => 'nullable|email'
					]
				);

				if ($validator->fails()) {
					return response()->json(['errors' => $this->valid($validator)]);
				}

				try {
					EmailSetting::updateOrCreate([
						'type' => $params['type']
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
		if (!env('USER_VERIFIED'))
		{
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}
		$logged_user = auth()->user();

		if (!!$logged_user)
		{
			EmailSetting::whereId($id)->delete();

			return response()->json(['success' => __('Data is successfully deleted')]);
		}

		return response()->json(['success' => __('You are not authorized')]);
	}

	public function show($id)
	{
		if (request()->ajax())
		{
			$data = EmailSetting::findOrFail($id);

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
					'subject',
					'content',
					'admin_email',
					'button_text',
					'type',
					'cc_email',
					'bcc_email'
				);

				$validator = Validator::make(
					$params,
					[
						'subject' => $rule,
						'content' => $rule,
						'admin_email' => 'nullable|email'
					]
				);
				if ($validator->fails()) {
					return response()->json(['errors' => $this->valid($validator)]);
				}

				try {
					EmailSetting::whereId($id)->update($params);
				} catch (Exception $e) {
					return response()->json(['error' => $e->getMessage()]);

				}

				return response()->json(['success' => __('Data update successfully.')]);
			}
		}

		return response()->json(['success' => __('You are not authorized')]);
	}
}
