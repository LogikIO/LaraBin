<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class ResetPasswordNew extends Request
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
            'new_password' => 'required|confirmed|min:6',
            'new_password_confirmation' => 'required'
        ];
    }
}
