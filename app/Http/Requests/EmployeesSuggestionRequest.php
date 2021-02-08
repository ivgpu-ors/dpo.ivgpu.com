<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeesSuggestionRequest extends FormRequest
{
    public function rules()
    {
        return [
            's' => 'nullable|string'
        ];
    }
}
