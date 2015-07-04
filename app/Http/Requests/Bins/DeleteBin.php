<?php

namespace App\Http\Requests\Bins;

use App\Http\Requests\Request;

class DeleteBin extends Request
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
