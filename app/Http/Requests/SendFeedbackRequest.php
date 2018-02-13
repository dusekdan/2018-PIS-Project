<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendFeedbackRequest extends FormRequest
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
            'contact' => 'required',
            'note' => 'required'
        ];
    }

    // No need to specify error messages, validation is client side as well, the only use case
    // when error reporting would make sense is when form is not submitted via browser -> which
    // is unwanted behavior and therefore we won't support it.
}
