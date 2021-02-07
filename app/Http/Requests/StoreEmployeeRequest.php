<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'full_name' => 'required|max:255',
            'post' => 'required|max:255',
        ];
    }
}
