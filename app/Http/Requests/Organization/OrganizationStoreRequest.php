<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required:string'],
            'email' => ['required:string'],
            'status' => ['boolean'],
            'password' => ['required:string'],
        ];
    }
}
