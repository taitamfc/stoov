<?php

namespace App\Http\Requests\EmailContact;

use Illuminate\Foundation\Http\FormRequest;

class PostFormLoonsomopgaveRequest extends FormRequest
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
            'uw_naam' => 'required',
            'email' => 'required|email',
            'telefoonnummer' => 'required',
            'reden' => 'required',
            'personeel_in_loondienst' => 'required',
            'loonsom' => 'required_if:personeel_in_loondienst,1,2',
            'aantal_medewerkers' => 'required_if:personeel_in_loondienst,1,2',
            'personeel_datum' => 'required_if:personeel_in_loondienst,2',
            'personeel_tot' => 'required_if:personeel_in_loondienst,2',
            'verklaring' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'naam_bedrijf.required' => 'Het veld naam_bedrijf is verplicht.',
            'uw_naam.required' => 'Het veld uw_naam is verplicht.',
            'telefoonnummer.required' => 'Het veld telefoonnummer is verplicht.',
            'email.required' => 'Het veld email is verplicht.',
            'email.email' => 'Het veld email bevat geen geldig e-mailadres.',
            'reden.required' => 'Het veld reden is verplicht.',
            'personeel_in_loondienst.required' => 'Het veld personeel_in_loondienst is verplicht.',
            'loonsom.required' => 'Het veld loonsom is verplicht.',
            'aantal_medewerkers.required' => 'Het veld aantal_medewerkers is verplicht.',
            'personeel_datum.required' => 'Het veld personeel_datum is verplicht.',
            'personeel_tot.required' => 'Het veld personeel_tot is verplicht.',
            'verklaring.required' => 'Het veld verklaring is verplicht.'
        ];
    }
}
