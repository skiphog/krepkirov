<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Admin
{

    public function index()
    {
        $orders = Order::orderBy('id','desc')->paginate(10);

        return view('admin.orders.index', compact('orders'));

    }

}
