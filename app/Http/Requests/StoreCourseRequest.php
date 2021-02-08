<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'enabled' => 'nullable|boolean',
            'start' => 'nullable|date',
            'end' => 'nullable|date',
            'duration' => 'required|string|max:255',
            'education_time' => 'required|string|max:255',
            'description' => 'required|string',
            'program' => 'required|string',
            'conditions' => 'nullable|string',
            'target_audience' => 'nullable|string',
            'impl_form' => 'required|string|max:255',
            'leader_id' => 'nullable|exists:employees,id',
            'teacher_ids' => 'array',
            'teacher_ids.*' => 'exists:employees,id',
        ];
    }
}
