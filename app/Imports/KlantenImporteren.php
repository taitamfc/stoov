<?php

namespace App\Imports;

use App\Client;
use App\Company;
use App\User;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use DB;

class KlantenImporteren implements ToCollection, WithHeadingRow, WithValidation, WithChunkReading
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
			"password",
			"berdrijf",
			"kvk",
			"straatnaam",
			"huisnummer",
			"stad",
			"postcode",
			"land",
			"btwnummer",
			"voornaam",
			"achternaam",
			"email_contact",
			"email_receipt",
			"telefoon",
		];
		
		$checkHeadersValid = array_intersect(array_keys($rows[0]->toArray()), $headers);
		if (count($checkHeadersValid) !== count($headers)) throw new \Exception('Het bestand heeft niet het juiste formaat');
		$countries = DB::table('countries')->get();
		foreach ($rows as $row) {
			$data = $this->convertParams($row, $countries);
			if (!$data || !@$data['username']) continue;
			$model = User::whereRelatienummer($row['relatienummer'])
				->whereNotNull('relatienummer')
				->first();

			$userData = [
				'first_name' => $data['first_name'],
				'last_name' => $data['last_name'],
				'username' => strtolower(trim($data['username'])),
				'contact_no' => $data['contact_no'] ?? $data['email'],
				'email' => strtolower(trim($data['email'])),
				'password' => @$row['password'] ? bcrypt($row['password']) : bcrypt('secret123!@#'),
				'is_active' => 1,
				'role_users_id' => 3,
				'relatienummer' => $data['relatienummer']
			];

			if ($model) {
				$model->update($userData);
				if ($model->client) {
					$model->client->update($data);
				} else {
					$data['id'] = @$model->id;
					Client::insert($data);
				}
			} else {
				$user = User::insert($userData);
				$data['id'] = @$user->id;
				if(@$user->client) $user->client->insert($data);
			}
		}
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
	public function convertParams($row, $countries)
	{
		$company = Company::whereOrganisatie($row['berdrijf'])->first();
		
		if (!@$company) {
			$companyData = [
				'organisatie' => $row['berdrijf'],
				'straat' => $row['straatnaam'],
				'number' => $row['huisnummer'],
				'post_code' => @$row['postcode'],
				'plaats' => $row['stad'],
				'contact_persoon' => $row['telefoon'],
				'telefoonnummer' => $row['telefoon'],
				'emailadres' => $row['email_contact'],
			];
			$company = Company::insert($companyData);
		}
		$land = $row['land'] === 'Nederland' ? 'Netherlands' : $row['land'];
		$country = $countries->where('name', $land)->first();
		return [
			'username' => implode(' ', [$row['voornaam'], $row['achternaam']]),
			'first_name' => $row['voornaam'],
			'last_name' => $row['achternaam'],
			'contact_no' => $row['telefoon'] ?? $row['email_contact'] ?? $row['email_receipt'],
			'email' => $row['email_contact'] ?? $row['email_receipt'],
			'address1' => $row['huisnummer'],
			'address2' => $row['straatnaam'],
			'city' => $row['stad'],
			'state' => null,
			'country' => @$country->id,
			'zip' => @$row['postcode'],
			'is_active' => 1,
			'company_id' => @$company->id ?? null,
			'relatienummer' => $row['relatienummer'],
			'kvk' => $row['kvk'],
			'email_receipt' => $row['email_receipt'],
			'btwnummer' => $row['btwnummer'],
		];
	}

	public function chunkSize(): int
	{
		return 500;
	}
}
