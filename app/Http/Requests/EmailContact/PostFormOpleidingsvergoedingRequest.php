<?php

namespace App\Http\Requests\EmailContact;

use Illuminate\Foundation\Http\FormRequest;

class PostFormOpleidingsvergoedingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $fileValid = 'required|max:20480';

        return [
            'naam_bedrijf' => 'required',
            'iban_nummer' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'course' => 'required',
            'naam_cursus' => 'required',
            'naam_opleidingsinstituut' => 'required',
            'datum_cursus_van' => 'required',
            'datum_tot' => 'required',
            'subsidiepercentage_dat_van_toepassing_is' => 'required',
            'totaalbedrag_subsidie_aanvraag' => 'required',
            'aard_van_de_cursus' => 'required',
            'factuur' => $fileValid,
            'certificaat' => $fileValid,
            'deelnemers' => 'required',
            'verklaring' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'naam_bedrijf.required' => 'Het veld naam_bedrijf is verplicht.',
            'iban_nummer.required' => 'Het veld iban_nummer is verplicht.',
            'first_name.required' => 'Het veld first_name is verplicht.',
            'middle_name.required' => 'Het veld middle_name is verplicht.',
            'last_name.required' => 'Het veld last_name is verplicht.',
            'email.required' => 'Het veld email is verplicht.',
            'email.email' => 'Het veld email bevat geen geldig e-mailadres.',
            'naam_cursus.required' => 'Het veld naam_cursus is verplicht.',
            'datum_cursus_van.required' => 'Het veld datum_cursus_van is verplicht.',
            'datum_tot.required' => 'Het veld datum_tot is verplicht.',
            'subsidiepercentage_dat_van_toepassing_is.required' => 'Het veld subsidiepercentage_dat_van_toepassing_is is verplicht.',
            'totaalbedrag_subsidie_aanvraag.required' => 'Het veld totaalbedrag_subsidie_aanvraag is verplicht.',
            'aard_van_de_cursus.required' => 'Het veld aard_van_de_cursus is verplicht.',
            'factuur.required' => 'Het veld factuur is verplicht.',
            'factuur.max' => 'Het veld factuur mag niet groter zijn dan 20 MB.',
            'certificaat.required' => 'Het veld certificaat is verplicht.',
            'certificaat.max' => 'Het veld certificaat mag niet groter zijn dan 20 MB.',
            'deelnemers.required' => 'Het veld deelnemers is verplicht.',
            'verklaring.required' => 'Het veld verklaring is verplicht.',
        ];
    }
}
