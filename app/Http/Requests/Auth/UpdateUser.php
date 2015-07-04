<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class UpdateUser extends Request
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
            'username' => 'required|min:3|unique:users,username,'.auth()->user()->getAuthIdentifier().'|regex:/\A[\w\-\.]+\z/',
            'email' => 'required|email|unique:users,email,'.auth()->user()->getAuthIdentifier(),
            'new_password' => 'required_with:new_password_confirmation|confirmed|min:6',
            'new_password_confirmation' => 'required_with:new_password'
        ];
    }

    public function messages()
    {
        return [
            'username.regex' => 'Only letters, numbers, dashes, underscores and periods.'
        ];
    }
}
