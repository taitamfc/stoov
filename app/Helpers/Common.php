<?php
use App\Certification;
use App\Course;
use Illuminate\Support\Arr;
use Carbon\Carbon;

if (! function_exists('checkNameSelect')) {
    /**
     * checkNameSelect
     *
     * @param Employee $employee
     */
    function checkNameSelect($employee)
    {
       return $employee->achternaam . ($employee->initialen ? '('. $employee->initialen . ')' : '') . (($employee->date_of_birth ? ' - ' : '') . \Carbon\Carbon::createFromDate($employee->date_of_birth)->format('d/m/Y'));
    }
}

if (! function_exists('showEmployeeCheckbox')) {
    /**
     * showEmployeeCheckbox
     *
     * @param Employee $employee
     */
    function showEmployeeCheckbox($employee)
    {
       return $employee->achternaam . ($employee->initialen ? '('. $employee->initialen . ')' : '');
    }
}

if (! function_exists('checkShowVakcertificaten')) {
    /**
     * checkShowVakcertificaten
     *
     */
    function checkShowVakcertificaten()
    {
        try {
            $logged_user = auth()->user();
            $companyId = $logged_user->client->company_id;
           
            return Certification::where(function($q) {
                    $q->where('gewenste_certificatie', '=', Certification::Glasmonteurs)
                     ->orWhere('gewenste_certificatie', '=', Certification::Beide)
                     ->orWhere('gewenste_certificatie', '=', Certification::Glaszetters);
                })
               	->whereHas('employee', function($q) use ($companyId) {
                    $q->whereHas('companies', function ($q) use ($companyId) {
			$q->whereId($companyId);
		    });
              	})
                ->exists();
        } catch (Exception $e) {
            return false;
        }
    }
}

if (! function_exists('getNumberFormat')) {
    /**
     * getNumberFormat
     *
     * @param int $amount
     */
    function getNumberFormat($amount)
    {
        if(config('variable.currency_format') ==='suffix') {
            return number_format($amount, 2, ',', '.') . " " . config('variable.currency'); 
        } else {
            return  config('variable.currency') . " " .  number_format($amount, 2, ',', '.'); 
        }
    }
}

if (! function_exists('unsets')) {
    /**
     * unsets
     *
     * @param array $fields
     * @param array $unsetslist
     * 
     */
    function unsets($fields, array $unsetslist = [])
    {
        $newFields = $fields;
        foreach($unsetslist as $item) {
            unset($newFields[$item]);
        }

        return $newFields;
    }
}

if (! function_exists('formatDate')) {
    /**
     * unsets
     *
     * @param array $fields
     * @param array $unsetslist
     * 
     */
    function formatDate($value, $format = null)
	{
		return @$value ? Carbon::parse($value)->format($format ?? env('Date_Format')) : null;
	}
}

if (! function_exists('convertDayNames')) {
    /**
     * Convert Day Names
     *
     * @param string $englishDayOfWeek
     * 
     */
    function convertDayNames($englishDayOfWeek)
	{
		$dutchDaysOfWeek = [
            'Monday' => 'Maandag',
            'Tuesday' => 'Dinsdag',
            'Wednesday' => 'Woensdag',
            'Thursday' => 'Donderdag',
            'Friday' => 'Vrijdag',
            'Saturday' => 'Zaterdag',
            'Sunday' => 'Zondag',
        ];
        
        if (array_key_exists($englishDayOfWeek, $dutchDaysOfWeek)) {
            $dutchDayOfWeek = $dutchDaysOfWeek[$englishDayOfWeek];
            return $dutchDayOfWeek;
        } 

        return null;
	}
}

if (! function_exists('checkSubmitLoomsom')) {
    function checkSubmitLoomsom()
	{
        $user = auth()->user();

		return Course::whereUserId($user->id)
			->whereType(Course::TYPE_LOONSOMOPGAVE)
			->whereYear('created_at', now()->year)
			->exists();
	}
}

if (! function_exists('removeExtension')) {
    /**
     * unsets
     *
     * @param array $fields
     * @param array $unsetslist
     * 
     */
    function removeExtension($value)
	{
        $file = explode('.', $value);
        return str_replace('.' . $file[count($file) - 1], '', $value);
	}
}