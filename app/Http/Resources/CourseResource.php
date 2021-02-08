<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

/** @mixin Course */
class CourseResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $teachers_ids = DB::table('course_employee')->where('course_id', '=', $this->id)->get('employee_id')->pluck('employee_id');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'enabled' => $this->enabled,
            'start' => $this->start,
            'end' => $this->end,
            'duration' => $this->duration,
            'education_time' => $this->education_time,
            'description' => $this->description,
            'program' => $this->program,
            'conditions' => $this->conditions,
            'target_audience' => $this->target_audience,
            'impl_form' => $this->impl_form,
            'leader_id' => $this->leader_id,
            'teachers_ids' => $teachers_ids,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
