<?php


namespace App\Services;


use App\Enums\OrderStatus;
use App\Models\Course;
use App\Models\Option;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Voronkovich\SberbankAcquiring\Client;

class OrderService
{
    private Client $sber;
    private string $returnUrl;
    private string $failUrl;

    /**
     * OrderService constructor.
     * @param Client $sber
     * @param string $returnUrl
     * @param string $failUrl
     */
    public function __construct(Client $sber, string $returnUrl, string $failUrl)
    {
        $this->sber = $sber;
        $this->returnUrl = $returnUrl;
        $this->failUrl = $failUrl;
    }

    /**
     * @param string $user_id
     * @param Course $course
     * @param Option $option
     * @param int $price
     * @return Order
     */
    public static function makeOrder(string $user_id, Course $course, Option $option, int $price): Order
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

    /**
     * @param Order $order
     * @return string Redirect url
     */
    public function registerOrder(Order $order): string
    {
        $returnUrl = url($this->returnUrl);
        $failUrl = url($this->failUrl);

        $params = [
            'failUrl' => $failUrl,
            'jsonParams' => [
                'type' => 'dpo'
            ]
        ];

        $order_id = preg_replace('/-/', '', $order->id);
        $result = $this->sber->registerOrder($order_id, $order->price * 100, $returnUrl, $params);
        $order->external_id = $result['orderId'];
        $order->save();

        return $result['formUrl'];
    }

    public function success($orderId): bool
    {
        $order = Order::where('external_id', $orderId)->first();
        $result = $this->sber->getOrderStatus($orderId);

        if (\Voronkovich\SberbankAcquiring\OrderStatus::isDeposited($result['orderStatus'])) {
            $order->status = OrderStatus::paid();
            $order->save();
            return true;
        }

        Log::error('Sber order status check error', ['result' => $result]);

        return false;
    }

    public function fail()
    {
        return redirect('/')->with('error', 'Ошибка обработки платежа');
    }
}
