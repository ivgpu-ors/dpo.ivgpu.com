<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderService $orderService;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function register(Order $order)
    {
        $location = $this->orderService->registerOrder($order);
        return redirect($location);
    }

    public function success(Request $request)
    {
        $orderId = $request->get('orderId');
        $order = Order::firstWhere('external_id', $orderId);

        if ($this->orderService->success($order)) {
            return redirect(route('account.orders'))->with('success_paid', true);
        } else {
            return redirect('/')->with('error', 'Что-то пошло не так.');
        }
    }

    public function fail(Request $request)
    {
        $orderId = $request->get('orderId');
        $order = Order::firstWhere('external_id', $orderId);

        $newOrder = $this->orderService->fail($order);
        $location = $this->orderService->registerOrder($newOrder);
        return redirect($location);
    }
}
