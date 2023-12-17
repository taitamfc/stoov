<?php

namespace App\Imports;

use App\Certification;
use App\Employee;
use App\Company;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CertificationImport implements ToCollection, WithHeadingRow, WithValidation, WithChunkReading
{
	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */

	public function collection(Collection $rows)
	{
		$data = [];
		foreach ($rows as $row) {
			$employee = Employee::where('achternaam', $row['achternaam'])
				->where('geboortedatum', $this->checkNullFormatDate($row['geboortedatum']))
				->first();

			$params = [
				'employee_id' => $employee ? $employee->id : null,
				'datum_uitgifte_vca' => $this->checkNullFormatDate($row['datum_uitgifte_vca']),
				'vervaldatum_vca' => $this->checkNullFormatDate($row['vervaldatum_vca']),
				'certificaatnummer' => $row['certificaatnummer'],
				'gewenste_certificatie' => $row['gewenste_certificatie'],
				'pasje_gecertificeerd_glasmonteur' => $row['pasje_gecertificeerd_glasmonteur'],
				'datum_gecertificeerd_glasmonteur' => $this->checkNullFormatDate($row['datum_gecertificeerd_glasmonteur']),
				'vervaldatum_gecertificeerd_glasmonteur' => $this->checkNullFormatDate($row['vervaldatum_gecertificeerd_glasmonteur']),
				'examen_glasmonteur' => $row['examen_glasmonteur'],
				'examencode_glasmonteur' => $row['examencode_glasmonteur'],
				'hercertificering_glasmonteur' => $row['hercertificering_glasmonteur'] == '=TRUE()',
				'datum_hercertificering_glasmonteur' => $this->checkNullFormatDate($row['datum_hercertificering_glasmonteur']),
				'vervaldatum_hercertificering_glasmonteur' => $this->checkNullFormatDate($row['vervaldatum_hercertificering_glasmonteur']),
				'hercertificeringscode_glasmonteur' => $row['hercertificeringscode_glasmonteur'],
				'hercertificeringscijfer_glasmonteur' => $row['hercertificeringscijfer_glasmonteur'],
				'hercertificeringspasnummer_glasmonteur' => $row['hercertificeringspasnummer_glasmonteur'],
				'pasje_gecertificeerd_glaszetter' => $row['pasje_gecertificeerd_glaszetter'],
				'datum_gecertificeerd_glaszetter' => $this->checkNullFormatDate($row['datum_gecertificeerd_glaszetter']),
				'vervaldatum_gecertificeerd_glaszetter' => $this->checkNullFormatDate($row['vervaldatum_gecertificeerd_glaszetter']),
				'examen_glaszetter' => $row['examen_glaszetter'],
				'examencode_glaszetter' => $row['examencode_glaszetter'],
				'examencijfer_glaszetter' => $row['examencijfer_glaszetter'],
				'hercertificering_glaszetter' => $row['hercertificering_glaszetter'] == '=TRUE()',
				'datum_hercertificering_glaszetter' => $this->checkNullFormatDate($row['datum_hercertificering_glaszetter']),
				'vervaldatum_hercertificering_glaszetter' => $this->checkNullFormatDate($row['vervaldatum_hercertificering_glaszetter']),
				'hercertificeringscode_glaszetter' => $row['hercertificeringscode_glaszetter'],
				'hercertificeringscijfer_glaszetter' => $row['hercertificeringscijfer_glaszetter'],
				'hercertificeringspasnummer_glaszetter' => $row['hercertificeringspasnummer_glaszetter'],
				'notitie' => $row['notitie'],
			];
			$data[] = $params;
		}

		Certification::insert($data);
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
