<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseOrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'contract_accept' => 'accepted'
        ];
    }
}
