<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequestStoreRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'birthdate' => 'required|date_format:d-m-Y',
            'vca_expiry_date' => 'required|date_format:d-m-Y',
            'working_since' => 'required|date_format:d-m-Y',
            'is_subcontractor' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Achternaam is required!',
            'first_name.max' => 'Achternaam is max',
            'last_name.required' => 'Naam is required!',
            'last_name.max' => 'Naam is max',
            'birthdate.required' => 'Geboortedatum is required!',
            'birthdate.max' => 'Geboortedatum incorrect format',
            'vca_expiry_date.required' => 'VCA Vervaldatum is required!',
            'vca_expiry_date.max' => 'VCA Vervaldatum incorrect format',
            'working_since.required' => 'Werkzaam sinds is required!',
            'working_since.max' => 'Werkzaam sinds incorrect format',
        ];
    }
}
