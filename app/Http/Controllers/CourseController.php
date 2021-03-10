<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Requests\CourseOrderRequest;
use App\Models\Course;
use App\Services\OrderService;

class CourseController extends Controller
{
    private OrderService $service;

    /**
     * CourseController constructor.
     * @param OrderService $service
     */
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function show(int $course_id)
    {
        $course = Course::with('teachers')->findOrFail($course_id);
        return view('courses.show', compact('course'));
    }

    public function signup(int $course_id, int $option_id)
    {
        $course = Course::active()->findOrFail($course_id);
        $option = $course->options()->where('option_id', $option_id)->first();

        return view('courses.signup', [
            'course' => $course,
            'option' => $option
        ]);
    }

    public function order(CourseOrderRequest $request, int $course_id, int $option_id)
    {
        $course = Course::active()->findOrFail($course_id);
        $option = $course->options()->where('option_id', $option_id)->first();
        $price = $option->pivot->price;

        $order = $this->service->makeOrder($request->user()->id, $course, $option, $price);

        if ($order->status->equals(OrderStatus::paid())) {
            return redirect(route('account.orders'))->with('success_paid', true);
        } else {
            return redirect(route('order.register', $order));
        }
    }
}
