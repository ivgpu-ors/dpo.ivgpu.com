<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CoursesController extends Controller
{
    /**
     * @var string
     */
    private $courseRegex;
    /**
     * @var int
     */
    private int $courseIdMatch;

    /**
     * CoursesController constructor.
     */
    public function __construct()
    {
        $this->courseRegex = config('moodle.course_regex');
        $this->courseIdMatch = intval(config('moodle.course_id_match'));
    }

    public function __invoke(Request $request): JsonResponse
    {
        $userEmail = $request->get('email');
        $user = User::with(['orders', 'orders.course'])->where('email', $userEmail)->sole();
        $ids = $this->get_courses_ids($user->orders);

        return response()->json($ids);
    }

    /**
     * @param Collection|Order[] $orders
     * @return array
     */
    private function get_courses_ids($orders): array
    {
        $ids = [];

        foreach ($orders as $order) {
            if (preg_match("/{$this->courseRegex}/", $order->course->content_url, $matches)) {
                $ids[] = $matches[$this->courseIdMatch];
            }
        }

        return $ids;
    }
}
