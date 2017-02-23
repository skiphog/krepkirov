<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Admin
{

    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders'));

    }

    public function show(Order $order)
    {
        $order->load('orderItems');

        return view('admin.orders.show', compact('order'));
    }

    public function update(Order $order, Request $request)
    {
        $order->update($request->all());

        return response()->json([
            'id' => $order->id,
            'status' => config('s.status_order.icon')[$order->status]
        ]);
    }

}
