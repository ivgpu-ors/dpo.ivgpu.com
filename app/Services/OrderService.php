<?php


namespace App\Services;


use App\Enums\OrderStatus;
use App\Models\Course;
use App\Models\Option;
use App\Models\Order;

class OrderService
{
    /**
     * @param string $user_id
     * @param Course $course
     * @param Option $option
     * @param int $price
     * @return Order
     */
    public static function createOrder(string $user_id, Course $course, Option $option, int $price): Order
    {
        if ($price > 0) {
            $status = OrderStatus::draft();
        } else {
            $status = OrderStatus::paid();
        }

        $order = new Order();
        $order->user_id = $user_id;
        $order->course_id = $course->id;
        $order->option_id = $option->id;
        $order->price = $price;
        $order->status = $status;

        $order->save();

        return $order;
    }
}
