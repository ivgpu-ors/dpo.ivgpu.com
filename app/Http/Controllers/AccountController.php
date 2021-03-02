<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function orders(Request $request)
    {
        $orders = $request->user()
            ->orders()
            ->with(['course', 'course.leader', 'option'])
            ->orderByDesc('status')
            ->get();

        return view('account.orders', compact('orders'));
    }
}
