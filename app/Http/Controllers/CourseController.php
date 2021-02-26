<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Requests\CourseOrderRequest;
use App\Models\Course;
use App\Models\Order;

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
        $price = $option->pivot->price;

        if ($price > 0) {
            $status = OrderStatus::draft();
        } else {
            $status = OrderStatus::paid();
        }

        $order = new Order();
        $order->user_id = $request->user()->id;
        $order->course_id = $course->id;
        $order->option_id = $option_id;
        $order->price = $price;
        $order->status = $status;

        $order->save();

        if ($order->status->equals(OrderStatus::paid())) {
            return redirect('/account/orders')->with('success_paid', true);
        } else {
            return redirect('/order/{order_id}');
        }
    }
}
