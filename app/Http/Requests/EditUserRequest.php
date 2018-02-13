<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('manager');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user-name' => 'required',
            'user-email' => 'required|email',
            'user-password' => 'confirmed',
            'user-role' => 'required'
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
            'user-name.required' => 'Jméno je vyžadováno.',
            'user-email.required'  => 'Email je vyžadován.',
            'user-email.email' => 'Email musí být ve správném tvaru.',
            'user-password.confirmed' => 'Hesla se musí shodovat.',
            'user-role.required' => 'Role je vyžadována.'
        ];
    }
}
