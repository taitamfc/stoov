<?php

namespace App\Imports;

use App\Client;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CompanyImport implements ToCollection, WithHeadingRow, WithValidation, WithChunkReading
{

	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */

	public function collection(Collection $rows)
	{
		foreach ($rows as $row) {
			$params = [
				'organisatie' => $row['organisatie'],
				'straat' => $row['straat'],
				'number' => $row['nummer'],
				'toevoeging' => $row['toevoeging'],
				'post_code' => $row['postcode'],
				'plaats' => $row['plaats'],
				'glaskeur' => $row['glaskeur'] === '=TRUE()' ? 1 : 0,
				'contact_persoon' => $row['contactpersoon'],
				'functie' => $row['functie'],
				'telefoonnummer' => $row['telefoonnummer'],
				'emailadres' => $row['emailadres'],
				'keurmerk' => $row['keurmerk'] === 'Y' ? 1 : 0,
				'details' => $row['details'],
			];
			$client = Client::where('relatienummer', $row[0])->first();
			if (@$client->company) {
				$client->company->update($params);
			}
			// else {
			// 	Company::create($params);
			// }
		}
	}


	public function rules(): array
	{
		$rule = 'required';

		return [
			'organisatie' => $rule,
		];
	}

	public function chunkSize(): int
	{
		return 500;
	}

	public function batchSize(): int
	{
		return 1000;
	}
}
