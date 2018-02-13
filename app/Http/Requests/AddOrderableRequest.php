<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddOrderableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !(Auth::user()->hasRole('obsluha'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'orderable-name' => 'required',
            'orderable-quantity' => 'required',
            'orderable-price' => 'required|numeric',
            'orderable-type' => 'required|numeric'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'orderable-name.required' => 'Název položky musí být vyplněn.',
            'orderable-quantity.required' => 'Množství musí být uvedeno.',
            'orderable-price.required' => 'Cena musí být uvedena.',
            'orderable-price.numeric' => 'Cena položky musí být číslo.',
            'orderable-type.required' => 'Typ položky musí být uveden.',
            'orderable-type.numeric' => 'Pokoušíte se provést operaci, která by porušila konzistenci databáze. To Vám nemůžeme dovolit. Pardon.'
        ];
    }
}
