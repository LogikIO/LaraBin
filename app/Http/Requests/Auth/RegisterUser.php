<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterUser extends Request
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
            'name' => 'required',
            'username' => 'required|min:4|unique:users,username|regex:/\A[\w\-\.]+\z/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'g-recaptcha-response' => 'required|recaptcha'
        ];
    }

    public function messages()
    {
        return [
            'username.regex' => 'Only letters, numbers, dashes, underscores and periods.',
            'g-recaptcha-response.required' => 'You must prove that you are human! :)'
        ];
    }
}
