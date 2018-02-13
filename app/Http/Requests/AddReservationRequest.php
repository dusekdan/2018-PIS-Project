<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AddReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "reservation-date" => "required",
            "time" => "required",
            "customer-name" => "required",
            "customer-email" => "required",
            "bookables" => "required"
        ];

    }

    public function messages()
    {
        return [
            "reservation-date.required" => "Uveďte prosím datum rezervace.",
            "time.required" => "Uveďte prosím čas rezervace.",
            "customer-name.required" => "Uveďte prosím Vaše jméno.",
            "customer-email.required" => "Uveďte prosím Váš email.",
            "bookables.required" => "Vyberte prosím jednotky, které chcete zarezervovat."
        ];

    }

}