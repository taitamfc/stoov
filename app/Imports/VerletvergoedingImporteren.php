<?php

namespace App\Imports;

use App\Company;
use App\Course;
use App\Package;
use App\User;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class VerletvergoedingImporteren implements ToCollection, WithHeadingRow, WithValidation, WithChunkReading
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
			"approved",
			"amount",
			"boekjaar",
			"bedrijf",
			"iban",
			"reden_afkeur",
			"inzenddatum",
			"datum_behandeld",
			"contactpersoon_voor_aanvraag_voornaam",
			"contactpersoon_voor_aanvraag_tussenvoegsel",
			"contactpersoon_voor_aanvraag_achternaam",
			"naam_cursus",
			"datum_cursus_van",
			"tot",
			"incompany_cursus",
			"voeg_getekende_deelnemerslijst_bij",
			"aantal_deelnemers_in_cursus",
			"naam_werknemer_voorletters",
			"naam_werknemer_tussenvoegsel",
			"naam_werknemer_achternaammeisjesnaam",
			"geboortedatum_werknemer",
			"hoogte_verletvergoeding",
			"naam_werknemer_2_voorletters",
			"naam_werknemer_2_tussenvoegsel",
			"naam_werknemer_2_achternaammeisjesnaam",
			"geboortedatum_werknemer_2",
			"hoogte_verletvergoeding_werknemer_2",
			"naam_werknemer_3_voorletters",
			"naam_werknemer_3_tussenvoegsel",
			"naam_werknemer_3_achternaammeisjesnaam",
			"geboortedatum_werknemer_3",
			"hoogte_verletvergoeding_werknemer_3",
			"naam_werknemer_4_voorletters",
			"naam_werknemer_4_tussenvoegsel",
			"naam_werknemer_4_achternaammeisjesnaam",
			"geboortedatum_werknemer_4",
			"hoogte_verletvergoeding_werknemer_4",
			"naam_werknemer_5_voorletters",
			"naam_werknemer_5_tussenvoegsel",
			"naam_werknemer_5_achternaammeisjesnaam",
			"geboortedatum_werknemer_5",
			"hoogte_verletvergoeding_werknemer_5",
			"naam_werknemer_6_voorletters",
			"naam_werknemer_6_tussenvoegsel",
			"naam_werknemer_6_achternaammeisjesnaam",
			"geboortedatum_werknemer_6",
			"hoogte_verletvergoeding_werknemer_6",
			"naam_werknemer_7_voorletters",
			"naam_werknemer_7_tussenvoegsel",
			"naam_werknemer_7_achternaammeisjesnaam",
			"geboortedatum_werknemer_7",
			"hoogte_verletvergoeding_werknemer_7",
			"naam_werknemer_8_voorletters",
			"naam_werknemer_8_tussenvoegsel",
			"naam_werknemer_8_achternaammeisjesnaam",
			"geboortedatum_werknemer_8",
			"hoogte_verletvergoeding_werknemer_8",
			"naam_werknemer_9_voorletters",
			"naam_werknemer_9_tussenvoegsel",
			"naam_werknemer_9_achternaammeisjesnaam",
			"geboortedatum_werknemer_9",
			"hoogte_verletvergoeding_werknemer_9",
			"naam_werknemer_10_voorletters",
			"naam_werknemer_10_tussenvoegsel",
			"naam_werknemer_10_achternaammeisjesnaam",
			"geboortedatum_werknemer_10",
			"hoogte_verletvergoeding_werknemer_10",
			"ik_verklaar_de_gegevens_naar_waarheid_te_hebben_ingevuld",
		];
		$checkHeadersValid = array_intersect(array_keys($rows[0]->toArray()), $headers);
		if (count($checkHeadersValid) !== count($headers)) throw new \Exception('Het bestand heeft niet het juiste formaat');
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
	 * @param array $row
	 *
	 * @return void
	 */
	public function convertParams($row)
	{
		$dataDeelnemerslijst = [];
		$amountRequest = 0;
		for ($x = 0; $x <= 9; $x++) {
			$i = $x ? '_' . ($x + 1) : '';
			$firstName = $row["naam_werknemer" . $i . "_voorletters"];
			if ($firstName) {
				$courseDateTimeArr =  explode("-", $row["geboortedatum_werknemer" . $i]);
				$hoogteVerletvergoeding = $this->convertTextVerletvergoeding(@$row["hoogte_verletvergoeding" . $i]);
				$dataDeelnemerslijst[$x + 1] = [
					'first_name' => $firstName,
					'middle_name' => @$row["naam_werknemer" . $i . "_tussenvoegsel"] ?? null,
					'last_name' => @$row["naam_werknemer" . $i . "_achternaammeisjesnaam"] ?? null,
					'geboortedatum_werknemer_dd' => @$courseDateTimeArr[2] ?? null,
					'geboortedatum_werknemer_mm' => @$courseDateTimeArr[1] ?? null,
					'geboortedatum_werknemer_jjjj' => @$courseDateTimeArr[0] ?? null,
					'hoogte_verletvergoeding' => $hoogteVerletvergoeding,
				];
				$amountRequest += (float) array_search($hoogteVerletvergoeding, config('course.compensation_amount'));
			}
		}
		$company = Company::whereOrganisatie($row['bedrijf'])->first();
		$user = User::whereRelatienummer($row['relatienummer'])->first();
		$email = @$company->emailadres ?? null;
		$naamCursus = @Package::whereValue($row['naam_cursus'])->first()->id ?? null;
		$params = [
			'naam_bedrijf' => $row['bedrijf'] ?? null,
			'iban_nummer' => $row['iban'] ?? null,
			'first_name' => $row['contactpersoon_voor_aanvraag_voornaam'] ?? null,
			'middle_name' => $row['contactpersoon_voor_aanvraag_tussenvoegsel'] ?? null,
			'last_name' => $row['contactpersoon_voor_aanvraag_achternaam'] ?? null,
			'email' => $email,
			'naam_cursus' => $naamCursus,
			'datum_cursus_van' => $row['datum_cursus_van'] ?? null,
			'datum_tot' => $row['tot'] ?? null,
			'deelnemersinfo_per_bestand' => $row['incompany_cursus'] ?? null,
			'deelnemerslijst' => $row['voeg_getekende_deelnemerslijst_bij'] ?? null,
			'aantal_deelnemers_in_cursus' => $row['aantal_deelnemers_in_cursus'] ?? 0,
			'data_deelnemerslijst' => $dataDeelnemerslijst,
			//new field
			'boekjaar' => $row['boekjaar'] ?? null,
			'reden_afkeur' => $row['reden_afkeur'] ?? null,
			'relatienummer' => $row['relatienummer'] ?? null,
			'ik_verklaar_de_gegevens_naar_waarheid_te_hebben_ingevuld' => $row['ik_verklaar_de_gegevens_naar_waarheid_te_hebben_ingevuld'] ?? null,
		];

		return [
			'id' => $row['id'] ?? null,
			'email' => $email,
			'content' => json_encode($params),
			'type' => Course::TYPE_VERLETVERGOEDING,
			'is_approved' => @$row['approved'] === 'Y' ? 1 : 0,
			'amount_request' => @$row['approved'] === 'Y' ? $row['amount'] : $amountRequest,
			'created_at' => @$row['inzenddatum'],
			'updated_at' => @$row['datum_behandeld'],
			'company_id' => @$user->client->company_id ?? null,
			'user_id' => @$user->id ?? null,
			'relatienummer' => @$row['relatienummer'],
		];
	}

	public function convertTextVerletvergoeding($text)
	{
		$result = [
			'2 dagdelen, dus € 150' => '2 dagdelen, totaal € 150',
			'1 dagdeel, totaal € 75' => '1 dagdeel, totaal € 75',
			'4 dagdelen, dus € 300 (alleen voor Basiskennis Glas)' => '4 dagdelen, totaal € 300 (alleen voor Basiskennis Glas)'
		];

		return @$result[$text] ?? null;
	}

	public function chunkSize(): int
	{
		return 500;
	}
}
