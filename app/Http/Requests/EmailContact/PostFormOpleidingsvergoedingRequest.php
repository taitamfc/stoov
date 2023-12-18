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
            'naam_bedrijf.required' => 'Het veld Naam bedrijf is verplicht.',
            'iban_nummer.required' => 'Het veld IBAN nummer is verplicht.',
            'first_name.required' => 'Het veld Voornaam is verplicht.',
            'middle_name.required' => 'Het veld Tussenvoegsel is verplicht.',
            'last_name.required' => 'Het veld Achternaam is verplicht.',
            'email.required' => 'Het veld E-mailadres is verplicht.',
            'email.email' => 'Het veld E-mailadres bevat geen geldig e-mailadres.',
            'naam_cursus.required' => 'Het veld Naam cursus is verplicht.',
            'naam_opleidingsinstituut.required' => 'Het veld Naam opleidingsinstituut is verplicht.',
            'datum_cursus_van.required' => 'Het veld Datum cursus van is verplicht.',
            'datum_tot.required' => 'Het veld Datum tot is verplicht.',
            'subsidiepercentage_dat_van_toepassing_is.required' => 'Het veld Vergoedingspercentage dat van toepassing is verplicht.',
            'totaalbedrag_subsidie_aanvraag.required' => 'Het veld Totaalbedrag opleidingsvergoeding ex BTW is verplicht.',
            'aard_van_de_cursus.required' => 'Het veld Aard van de cursus is verplicht.',
            'factuur.required' => 'Het veld Factuur is verplicht.',
            'factuur.max' => 'Het veld Factuur mag niet groter zijn dan 20 MB.',
            'certificaat.required' => 'Het veld Certificaat is verplicht.',
            'certificaat.max' => 'Het veld Certificaat mag niet groter zijn dan 20 MB.',
            'deelnemers.required' => 'Het veld Deelnemers is verplicht.',
            'verklaring.required' => 'Het veld Verklaring is verplicht.',
        ];
    }
}
