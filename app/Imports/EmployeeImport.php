<?php

namespace App\Imports;

use App\Employee;
use App\Company;
use App\User;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EmployeeImport implements ToCollection, WithHeadingRow, WithValidation, WithChunkReading
{
	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */

	public function collection(Collection $rows)
	{
		foreach ($rows as $row) {
			// $user = User::whereRelatienummer($row['rnummer'])->first();
			$companyNames = explode("|", $row['organisatie']);
			$companyIds = count($companyNames) ? Company::whereIn('organisatie', $companyNames)->select('id')->get()->pluck('id')->toArray() : [];
			$params = [
				'initialen' => @$row['initialen'],
				'tussenvoegsel' => $row['tussenvoegsel'],
				'toevoeging' => $row['toevoeging'],
				'achternaam' => $row['achternaam'],
				'geboortedatum' => $this->checkNullFormatDate($row['geboortedatum']),
				'geboorteplaats' => $row['geboorteplaats'],
				'actief' => $row['aktief'] == '=TRUE()',
				'in_dienst' => $row['in_dienst'] == '=TRUE()',
				'indienst_sinds' => $this->checkNullFormatDate($row['indienst_sinds']),
				'is_onderaannemer' => $row['is_onderaannemer'] == '=TRUE()',
				'onderaannemer_sinds' => $this->checkNullFormatDate($row['onderaannemer_sinds']),
				'vevaldatum_vca' => $this->checkNullFormatDate($row['vevaldatum_vca']),
				'vervaldatum_glasmonteur' => $this->checkNullFormatDate($row['vervaldatum_glasmonteur']),
				'vervaldatum_glaszetter' => $this->checkNullFormatDate($row['vervaldatum_glaszetter']),
			];
			$employee = Employee::updateOrCreate([
				'achternaam' => $row['achternaam'],
				'geboortedatum' => $this->checkNullFormatDate($row['geboortedatum'])
			], $params);
			$employee->companies()->detach();
			foreach ($companyIds as $company) {
				$employee->companies()->attach($company);
			}
		}
	}

	public function rules(): array
	{
		$required = 'required';
		$nullable = 'nullable';

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

	public function chunkSize(): int
	{
		return 500;
	}
}
