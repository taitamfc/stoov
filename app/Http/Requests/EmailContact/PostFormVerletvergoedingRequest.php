<?php

namespace App\Http\Requests\EmailContact;

use Illuminate\Foundation\Http\FormRequest;

class PostFormVerletvergoedingRequest extends FormRequest
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
        return [
            'naam_bedrijf' => 'required',
            'iban_nummer' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            // 'naam_cursus' => 'required',
            'datum_cursus_van' => 'required',
            'datum_tot' => 'required'
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
            'datum_cursus_van.required' => 'Het veld Datum cursus van is verplicht.',
            'datum_tot.required' => 'Het veld Datum cursus tot is verplicht.'
        ];
    }
}
