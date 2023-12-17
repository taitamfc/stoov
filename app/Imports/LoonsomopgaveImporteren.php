<?php

namespace App\Imports;

use App\Company;
use App\Course;
use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class LoonsomopgaveImporteren implements ToCollection, WithHeadingRow, WithValidation, WithChunkReading
{
	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function collection(Collection $rows)
	{
		$headers = [
			"relatienummer",
			"id",
			"inzenddatum",
			"datum_bewerkt",
			"bedrijf",
			"uw_naam_voornaam",
			"uw_naam_tussenvoegsel",
			"uw_naam_achternaam",
			"personeel_in_loondienst",
			"personeel_in_loondienst_gehad_van_datum",
			"tot_datum",
			"loonsom_euro",
			"aantal_medewerkers_per_31_december_2022",
			"toelichting_enof_opmerkingen",
			"ik_verklaar_de_gegevens_naar_waarheid_te_hebben_ingevuld",
		];
		$checkHeadersValid = array_intersect(array_keys($rows[0]->toArray()), $headers);
		// if (count($checkHeadersValid) !== count($headers)) throw new \Exception('Het bestand heeft niet het juiste formaat');
		$dataInsert = [];
		foreach ($rows as $row) {
			$data = $this->convertParams($row);
			if (!$data) continue;
			$model = Course::whereId($data['id'])
				->first();
			if ($model) {
				$model->update($data);
			} else {
				$dataInsert[] = $data;
			}
		}

		Course::insert($dataInsert);
	}

	public function rules(): array
	{
		return [];
	}

	/** 
	 * @param mixed $input
	 *
	 * @return null|string
	 */
	public function checkNullFormatDate($input)
	{
		try {
			if ($input === null || $input === '') {
				return null;
			} else {
				return Date::excelToDateTimeObject($input)->format('Y-m-d');
			}
		} catch (\Exception $e) {
			return null;
		}
	}

	/**
	 * Convert params
	 *
	 * @param  array $row
	 *
	 * @return void
	 */
	public function convertParams($row)
	{
		if (!@$row['bedrijf']) return null;
		$company = Company::whereOrganisatie($row['bedrijf'])->first();
		$user = User::whereRelatienummer($row['relatienummer'])->first();
		if (!$company) return null;
		$email = @$company->emailadres ?? null;
		$params = [
			'relatienummer' => $row['relatienummer'] ?? null,
			'naam_bedrijf' => $row['bedrijf'] ?? null,
			'uw_naam' => implode(' ', [$row['uw_naam_voornaam'], $row['uw_naam_achternaam'], $row['uw_naam_tussenvoegsel']]),
			'email' => $email,
			'telefoonnummer' => $row['telefoonnummer'] ?? null,
			'reden' => $row['reden'] ?? null,
			'reden_other' => $row['reden_other'] ?? null,
			'personeel_in_loondienst' => $row['personeel_in_loondienst'] ? $this->searchTextPersoneel($row['personeel_in_loondienst']) : null,
			'personeel_datum' => $row['personeel_in_loondienst_gehad_van_datum'] ?? null,
			'personeel_tot' => $row['tot_datum'] ?? null,
			'loonsom' => $row['loonsom_euro'] ?? null,
			'aantal_medewerkers' => $row['aantal_medewerkers_per_31_december_2022'] ?? null,
			'toelichting_en_of_opmerkingen' => $row['ik_verklaar_de_gegevens_naar_waarheid_te_hebben_ingevuld'] ?? null,
			'verklaring' => 1,
		];

		return [
			'id' => $row['id'] ?? null,
			'email' => $email,
			'content' => json_encode($params),
			'type' => Course::TYPE_LOONSOMOPGAVE,
			'is_approved' => 0,
			'amount_request' => 0,
			'created_at' => @$row['inzenddatum'] ?? null,
			'updated_at' => @$row['datum_bewerkt'] ?? null,
			'company_id' => @$user->client->company_id ?? null,
			'user_id' => @$user->id ?? null,
			'relatienummer' => @$row['relatienummer'],
			'boekjaar' =>  $row['inzenddatum'] ? Carbon::parse($row['inzenddatum'])->format('Y') - 1 : null,
		];
	}

	public function chunkSize(): int
	{
		return 500;
	}

	public function searchTextPersoneel($value)
	{
		if (strpos($value, 'Ja, geheel') !== false) {
			return Course::PERSONEEL_IN_LOONDIENST_1;
		} elseif (strpos($value, 'Ja, een deel van') !== false) {
			return Course::PERSONEEL_IN_LOONDIENST_2;
		} elseif (strpos($value, 'Nee') !== false) {
			return Course::PERSONEEL_IN_LOONDIENST_3;
		}

		return null;
	}
}
