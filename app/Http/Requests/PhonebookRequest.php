<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

class PhonebookRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name' => 'required|max:32',
            'phone' => 'required|numeric|digits:12|unique:phonebooks,phone,'.$request->id,
            'email'=> 'required|email|unique:phonebooks,email,'.$request->id,
            'description' => 'required|max:800'
        ];
    }

}