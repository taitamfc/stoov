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
            'naam_bedrijf.required' => 'Het veld naam_bedrijf is verplicht.',
            'iban_nummer.required' => 'Het veld iban_nummer is verplicht.',
            'first_name.required' => 'Het veld first_name is verplicht.',
            'middle_name.required' => 'Het veld middle_name is verplicht.',
            'last_name.required' => 'Het veld last_name is verplicht.',
            'email.required' => 'Het veld email is verplicht.',
            'email.email' => 'Het veld email bevat geen geldig e-mailadres.',
            'naam_cursus.required' => 'Het veld naam_cursus is verplicht.',
            'datum_cursus_van.required' => 'Het veld datum_cursus_van is verplicht.',
            'datum_tot.required' => 'Het veld datum_tot is verplicht.'
        ];
    }
}
