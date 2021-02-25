<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
    public function show(int $course_id)
    {
        $course = Course::with('teachers')->findOrFail($course_id);
        return view('courses.show', compact('course'));
    }
}
