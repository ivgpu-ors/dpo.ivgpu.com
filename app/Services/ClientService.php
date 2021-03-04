<?php


namespace App\Services;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ClientService
{
    public function all(): LengthAwarePaginator
    {
        $users = DB::table('users')
            ->select([
                'users.id',
                'users.last_name',
                'users.first_name',
                'users.middle_name',
                'users.photo',
                'users.phone',
                'users.email',
                DB::raw('COUNT(orders.id) as orders_all'),
                DB::raw('COUNT(CASE WHEN orders.status > 0 THEN orders.id END) as orders_paid'),
                DB::raw('SUM(CASE WHEN orders.status > 0 THEN orders.price ELSE 0 END) as orders_sum'),
            ])
            ->leftJoin('orders', 'orders.user_id', '=', 'users.id')
            ->groupBy('users.id')
            ->paginate(50);

        return $users;
    }
}
