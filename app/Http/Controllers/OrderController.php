<?php

namespace App\Http\Controllers;

use App\Components\OrderComponent;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderShip;
use Mail;

class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderComponent $order)
    {
        $this->order = $order;
    }

    public function store(OrderRequest $orderRequest)
    {
        if (($order = $this->order->createOrder($orderRequest)) === false) {
            return redirect()->action('CartController@show')->withErrors(trans('ru.order.failed'));
        }

        Mail::to('angor-43@mail.ru')->send(new OrderShip($order));

        return redirect()->action('CartController@show')->with([
            'status' => trans('ru.order.success')
        ]);
    }
}