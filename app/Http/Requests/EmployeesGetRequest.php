<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeesGetRequest extends FormRequest
{
    public function rules()
    {
        return [
            'ids' => 'nullable|array',
            'ids.*' => 'integer'
        ];
    }
}
