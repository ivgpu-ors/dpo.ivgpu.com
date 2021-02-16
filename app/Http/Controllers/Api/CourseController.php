<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $courses = Course::all(['id', 'name', 'enabled']);
        return response()->json($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourseRequest $request
     * @return JsonResponse
     */
    public function store(StoreCourseRequest $request): JsonResponse
    {
        $options = [];
        foreach ($request->post('options') as $o) {
            $options[$o['option']['id']] = ['price' => $o['price']];
        }

        $course = Course::create($request->post());
        $course->teachers()->sync($request->post('teachers_ids'));
        $course->options()->sync($options);

        return response()->json(new CourseResource($course));
    }

    public function toggle(Course $course): JsonResponse
    {
        $course->enabled = !$course->enabled;
        $course->save();

        return response()->json($course->enabled);
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return JsonResponse
     */
    public function show(Course $course): JsonResponse
    {
        return response()->json(new CourseResource($course));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Course $course
     * @return JsonResponse
     */
    public function update(Request $request, Course $course): JsonResponse
    {
        $options = [];
        foreach ($request->post('options') as $o) {
            $options[$o['option']['id']] = ['price' => $o['price']];
        }

        $course->fill($request->post())->save();
        $course->teachers()->sync($request->post('teachers_ids'));
        $course->options()->sync($options);

        return response()->json(new CourseResource($course));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Course $course): JsonResponse
    {
        $course->delete();
        return response()->json();
    }
}
