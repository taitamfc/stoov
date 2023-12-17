<?php

namespace App\Imports;

use App\Budget;
use App\Company;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class BudgettenImporteren implements ToCollection, WithHeadingRow, WithValidation, WithChunkReading
{
	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function collection(Collection $rows)
	{
		$dataInsert = [];
		$headers = [
			"relatienummer",
			"boekjaar",
			"budget_jaartal",
			"bedrijf",
			"loonsom_opgegeven",
			"overheveling_budget",
			"loonsom_euro",
			"medewerkers_aantal",
			"datum_opgave",
			"premie",
			"vakbondsbijdr",
			"opleidingsbudget",
			"total_budget",
		];
		$checkHeadersValid = array_intersect(array_keys($rows[0]->toArray()), $headers);
		if (count($checkHeadersValid) !== count($headers)) throw new \Exception('Het bestand heeft niet het juiste formaat');
		foreach ($rows as $row) {
			$data = $this->convertParams($row);
			if (!$data) continue;
			$model = Budget::whereRelatienummer($data['relatienummer'])
				->first();
			if ($model) {
				$model->update($data);
			} else {
				$dataInsert[] = $data;
			}
		}

		Budget::insert($dataInsert);
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
			if ($input === null || $input === '' || $input === '0') {
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
		$company = Company::whereOrganisatie($row['bedrijf'])->first();
		$loonsomEuro = (float)@$row['loonsom_euro'];
		$overhevelingBudget = (float)@$row['overheveling_budget'];
		$premie = $loonsomEuro * 0.5 / 100;
		$vakbondsbijdr = $loonsomEuro * 0.024 / 100;
		$opleidingsbudget = $premie * 0.4;
		$amount = $overhevelingBudget + $opleidingsbudget;
		if (!$company) return null;

		return [
			'year' => @$row['boekjaar'],
			'company_id' => @$company->id,
			'relatienummer' => @$row['relatienummer'],
			'budget_jaartal' => @$row['budget_jaartal'],
			'loonsom_opgegeven' => @$row['loonsom_opgegeven'] === 'Y' ? 1 : 0,
			'overheveling_budget' => @$row['overheveling_budget'],
			'loonsom_euro' => $loonsomEuro,
			'medewerkers_aantal' => @$row['medewerkers_aantal'],
			'datum_opgave' => $this->checkNullFormatDate(@$row['datum_opgave']),
			'premie' => $premie,
			'vakbondsbijdr' => $vakbondsbijdr,
			'opleidingsbudget' => $opleidingsbudget,
			'amount' => $amount,
		];
	}

	public function chunkSize(): int
	{
		return 500;
	}
}
