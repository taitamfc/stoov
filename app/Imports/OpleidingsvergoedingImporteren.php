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

class OpleidingsvergoedingImporteren implements ToCollection, WithHeadingRow, WithValidation, WithChunkReading
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
			"e_mailadres_contactpersoon_voor_aanvraag",
			"cursus_in_stoov_overzicht_vergoedingspercentrages",
			"naam_cursus",
			"informatie_over_de_cursus",
			"naam_opleidingsinstituut",
			"informatie_over_het_opleidingsinstituut",
			"datum_cursus_van",
			"tot",
			"vergoedingspercentage_dat_van_toepassing_is",
			"totaalbedrag_vergoedings_aanvraag",
			"aard_van_de_cursus",
			"factuur",
			"bewijs_van_deelname_certificaat",
			"meer_of_minder_dan_10_deelnemers",
			"aantal_deelnemers_in_cursus",
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
			"deelnemersinfo_per_bestand",
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
		for ($x = 0; $x <= 9; $x++) {
			$i = $x ? '_' . ($x + 1) : '';
			$firstName = $row["naam_werknemer" . $i . "_voorletters"];
			if ($firstName) {
				$courseDateTimeArr =  explode("-", $row["geboortedatum_werknemer" . $i]);
				$dataDeelnemerslijst[$x + 1] = [
					'first_name' => $firstName,
					'middle_name' => @$row["naam_werknemer" . $i . "_tussenvoegsel"],
					'last_name' => @$row["naam_werknemer" . $i . "_achternaammeisjesnaam"],
					'geboortedatum_werknemer_dd' => @$courseDateTimeArr[2],
					'geboortedatum_werknemer_mm' => @$courseDateTimeArr[1],
					'geboortedatum_werknemer_jjjj' => @$courseDateTimeArr[0],
				];
			}
		}
		$company = Company::whereOrganisatie($row['bedrijf'])->first();
		$naamCursus = @Package::whereValue($row['naam_cursus'])->first()->id ?? null;
		$user = User::whereRelatienummer($row['relatienummer'])->first();
		$params = [
			'boekjaar' => $row['boekjaar'] ?? null,
			'naam_bedrijf' => $row['bedrijf'] ?? null,
			'iban_nummer'  => $row['iban'] ?? null,
			'first_name'  => $row['contactpersoon_voor_aanvraag_voornaam'] ?? null,
			'middle_name'  => $row['contactpersoon_voor_aanvraag_tussenvoegsel'] ?? null,
			'last_name'  => $row['contactpersoon_voor_aanvraag_achternaam'] ?? null,
			'email'  => $row['e_mailadres_contactpersoon_voor_aanvraag'] ?? null,
			'course'  => $row['cursus_in_stoov_overzicht_vergoedingspercentrages'] ?? null, // chưa
			'naam_cursus'  => $naamCursus,
			'cursus_info'  => $row['informatie_over_de_cursus'] ?? null ?? '',
			'naam_opleidingsinstituut'  => $row['naam_opleidingsinstituut'] ?? null,
			'datum_cursus_van'  => $row['datum_cursus_van'] ?? null,
			'datum_tot'  => $row['tot'] ?? null,
			'subsidiepercentage_dat_van_toepassing_is'  => $row['vergoedingspercentage_dat_van_toepassing_is'] ?? null,
			'totaalbedrag_subsidie_aanvraag'  => $row['totaalbedrag_vergoedings_aanvraag'] ?? null,
			'aard_van_de_cursus'  => $row['aard_van_de_cursus'] ?? null,
			'factuur' => $row['factuur'] ?? null,
			'certificaat' => $row['bewijs_van_deelname_certificaat'] ?? null,
			'deelnemers'  => $row['meer_of_minder_dan_10_deelnemers'] ?? null,
			'verklaring'  => 1,
			'data_deelnemerslijst' => $dataDeelnemerslijst,
			'aantal_deelnemers_in_cursus' => $row['aantal_deelnemers_in_cursus'] ?? null,
			'informatie_over_het_opleidingsinstituut' => $row['informatie_over_het_opleidingsinstituut'] ?? null,
			'deelnemersinfo_per_bestand' => $row['deelnemersinfo_per_bestand'] ?? null,
		];

		$amountTotal = (float) $params['subsidiepercentage_dat_van_toepassing_is'] / 100 * (float) $params['totaalbedrag_subsidie_aanvraag'];

		return [
			'id' => $row['id'],
			'email' => $params['email'],
			'content' => json_encode($params),
			'type' => Course::TYPE_OPLEIDINGSVERGOEDING,
			'is_approved' => @$row['approved'] === 'Y' ? 1 : 0,
			'amount_request' => @$row['approved'] === 'Y' ? $row['amount'] : $amountTotal,
			'created_at' => @$row['inzenddatum'],
			'updated_at' => @$row['datum_behandeld'],
			'company_id' => @$user->client->company_id ?? null,
			'user_id' => @$user->id ?? null,
			'relatienummer' => @$row['relatienummer'],
		];
	}

	public function chunkSize(): int
	{
		return 500;
	}
}
