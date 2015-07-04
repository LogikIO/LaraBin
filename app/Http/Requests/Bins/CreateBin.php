<?php

namespace App\Http\Requests\Bins;

use App\Http\Requests\Request;

class CreateBin extends Request
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
        $rules = [
            'title' => 'required',
            'visibility' => 'required|in:0,1,2'
        ];

        foreach($this->request->get('name') as $key => $value)
        {
            $rules['name.'.$key] = 'required';
        }

        foreach($this->request->get('language') as $key => $value)
        {
            $rules['language.'.$key] = 'required|exists:snippet_types,css_class';
        }

        foreach($this->request->get('code') as $key => $value)
        {
            $rules['code.'.$key] = 'required';
        }

        return $rules;
    }
}
