<?php

namespace App\Http\Controllers;

use App\Components\OrderComponent;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderComponent $order)
    {
        $this->order = $order;
    }

    public function store(OrderRequest $orderRequest)
    {
        //todo: Перенести сообщения в lang:ru

        if($this->order->createOrder($orderRequest) === false) {
            return redirect()->action('CartController@show')->withErrors(trans('ru.order.failed'));
        }

        //todo: mail send || listener

        return redirect()->action('CartController@show')->with([
            'status' => trans('ru.order.success')
        ]);
    }
}
