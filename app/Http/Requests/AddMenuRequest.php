<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AddMenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasAnyRole(['kuchar', 'manager']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "menu-validity-start" => "required",
            "menu-validity-end" => "required",
            "menu-name" => "required",
            "menu-soup" => ["required", Rule::notIn([-1])],
            "menu-meal-1" => ["required", Rule::notIn([-1])]
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
            'menu-validity-start.required' => 'Začátek platnosti menu musí být uveden.',
            'menu-validity-end.required' => 'Konec platnosti menu musí být uveden.',
            'menu-name.required' => 'Název menu musí být uveden.',
            'menu-soup.required' => 'Polévka musí být vybrána.',
            'menu-meal-1.required' => 'Alespoň jedno jídlo musí být vybráno.',
            'menu-soup.not_in' => "Polévka musí být vybrána.",
            'menu-meal-1.not_in' => 'Jídlo 1 musí být vybráno.'
        ];
    }
}
