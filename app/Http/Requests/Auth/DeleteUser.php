<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;
use Hash;

class DeleteUser extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $password = $this->request->get('password');

        // If user has a set password, Must confirm
        // GitHub users are not required to have a password
        if (auth()->user()->getAuthPassword()) {
            if (!Hash::check($password, auth()->user()->getAuthPassword())) {

                return false;
            }
        }

        return true;
    }

    public function forbiddenResponse()
    {
        session()->flash('error', 'Your current password is incorrect!');

        return redirect()->back();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'agree' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'agree.required' => 'You must acknowledge that you agree!'
        ];
    }
}
