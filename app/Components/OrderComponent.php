<?php

namespace App\Components;


use App\Cart;
use App\Order;
use App\Product;
use App\Http\Requests\OrderRequest;
use Illuminate\Database\Eloquent\Collection;

class OrderComponent
{
    public function createOrder(OrderRequest $request)
    {
        $cart = Cart::where('cookie_id', $request->cookie('cart'))->get();

        if ($cart->isEmpty()) {
            return false;
        }

        $data = $this->mergeData($request, $cart);

        return $this->insertOrder($data, $cart);
    }

    private function mergeData(OrderRequest $request, Collection $cart): array
    {
        return array_merge($request->all(), [
            'positions' => $cart->count(),
            'sum'       => $cart->sum('total_sum'),
            'weight'    => $cart->sum('weight')
        ]);
    }

    private function insertOrder(array $data, Collection $cart)
    {
        /** @var Order $order */
        $order = Order::create($data);

        $products = Product::find($cart->pluck('product_id')->toArray())->keyBy('id')->toArray();

        $data = [];

        foreach ($cart->keyBy('product_id') as $key => $value) {
            $data[] = [
                'order_id' => $order->id,
                'id_1c'    => $products[$key]['id_1c'],
                'name'     => $products[$key]['name'],
                'price'    => $products[$key]['price_1'],
                'unit'     => $products[$key]['unit'],
                'quantity' => $products[$key]['unit'] === 'тыс. шт' ? $value['qty'] / 1000 : $value['qty'],
                'sum'      => $value['total_sum'],
            ];
        }

        if (\DB::table('order_items')->insert($data) === false) {
            $order->delete();
            return false;
        }

        (new CartDb())->destroy();

        return $order;
    }

}