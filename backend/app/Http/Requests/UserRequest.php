<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' =>     'required|string|max:255',
            'email' =>    'required|email|max:255',
            'password' => 'required|string',
        ];
    }
}