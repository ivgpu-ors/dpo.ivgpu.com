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

        $order = Order::firstOrNew([
            'user_id' => $user_id,
            'course_id' => $course->id,
            'option_id' => $option->id,
        ]);

        $order->price = $price;
        if ($price === 0 && $order->status->equals(OrderStatus::draft())) {
            $order->status = OrderStatus::paid();
        }

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

        $order_id = 'dpo' . now()->format('yd') . $order->id;
        $result = $this->sber->registerOrder($order_id, $order->price * 100, $returnUrl, $params);
        $order->external_id = $result['orderId'];
        $order->pay_url = $result['formUrl'];
        $order->save();

        return $result['formUrl'];
    }

    public function success(Order $order): bool
    {
        $result = $this->sber->getOrderStatus($order->external_id);

        if (\Voronkovich\SberbankAcquiring\OrderStatus::isDeposited($result['orderStatus'])) {
            $order->status = OrderStatus::paid();
            $order->save();
            return true;
        }

        Log::error('Sber order status check error', ['result' => $result]);

        return false;
    }

    /**
     * @param Order $order
     * @return Order
     * @throws \Throwable
     */
    public function remake(Order $order): Order
    {
        $newOrder = self::makeOrder($order->user_id, $order->course, $order->option, $order->price);
        $order->delete();

        return $newOrder;
    }

    /**
     * @param Order $order
     * @return Order|null
     */
    public function fail(Order $order): ?Order
    {
        $result = $this->sber->getOrderStatus($order->external_id);

        if (\Voronkovich\SberbankAcquiring\OrderStatus::isDeclined($result['orderStatus'])) {
            try {
                return $this->remake($order);
            } catch (\Throwable $e) {
                return null;
            }
        }

        return null;
    }
}
