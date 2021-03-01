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
        if ($this->orderService->success($orderId)) {
            return redirect('/account/orders')->with('success_paid', true);
        } else {
            return redirect('/')->with('error', 'Что-то пошло не так.');
        }
    }
}
