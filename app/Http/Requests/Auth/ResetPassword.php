<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class ResetPassword extends Request
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
            'email' => 'required|email|exists:users,email',
            'g-recaptcha-response' => 'required|recaptcha'
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'You must prove that you are human! :)'
        ];
    }
}
