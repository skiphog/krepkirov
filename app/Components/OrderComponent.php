<?php

namespace App\Components;


use App\Http\Requests\OrderRequest;
use App\Order;
use App\Product;
use App\Traits\SessionCart;

class OrderComponent
{
    use SessionCart;


    public function createOrder(OrderRequest $request)
    {
        /** @var Order $order */
        $order = Order::create($request->all());

        $products = Product::find(array_keys($request->session()->get('cart')))->keyBy('id')->toArray();

        $data = [];

        foreach ((array)$request->session()->get('cart') as $key => $value) {
            $data[] = [
                'order_id' => $order->id,
                'id_1c' => $products[$key]['id_1c'],
                'name' => $value['name'],
                'price' => $products[$key]['price_1'],
                'unit' => $products[$key]['unit'],
                'quantity' => $products[$key]['unit'] === 'тыс. шт' ? $value['qty'] / 1000 : $value['qty'],
                'sum' => $value['sum'],
            ];
        }

        if(\DB::table('order_items')->insert($data) === false) {
            $order->delete();
            return false;
        }

        $this->clearCart();

        return true;
    }

}