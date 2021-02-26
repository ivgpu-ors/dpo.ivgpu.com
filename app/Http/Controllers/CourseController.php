<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseOrderRequest;
use App\Models\Course;

class CourseController extends Controller
{
    public function show(int $course_id)
    {
        $course = Course::with('teachers')->findOrFail($course_id);
        return view('courses.show', compact('course'));
    }

    public function signup(Course $course, int $option_id)
    {
        $option = $course->options()->where('option_id', $option_id)->first();

        return view('courses.signup', [
            'course' => $course,
            'option' => $option
        ]);
    }

    public function order(CourseOrderRequest $request, Course $course, int $option_id)
    {
        $option = $course->options()->where('option_id', $option_id)->first();
    }
}
