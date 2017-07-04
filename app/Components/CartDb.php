<?php

namespace App\Components;

use App\Cart;
use App\Product;
use App\Http\Requests\CartRequest;
use DB;

class CartDb
{
    public function changeCart(Product $product, CartRequest $request): array
    {
        if ((int)$request->qtw === 0) {
            return $this->deleteCart($product->id, $request);
        }

        $param = $product->unit === 'тыс. шт' ? [
            'sum'    => $product->price_1 * $request->qtw / 1000,
            'weight' => (float)$product->weight * $request->qtw / 1000
        ] : [
            'sum'    => $product->price_1 * $request->qtw,
            'weight' => (float)$product->weight * $request->qtw
        ];

        Cart::updateOrCreate(
            ['cookie_id' => $request->cookie('cart'), 'product_id' => $product->id],
            ['qty' => $request->qtw, 'weight' => $param['weight'], 'total_sum' => $param['sum']]
        );

        $cart = $this->getCartTotal();

        return [
            'status'       => 1,
            'sum'          => $this->numberFormat($param['sum']),
            'small_weight' => $this->numberFormat($param['weight']),
            'count'        => $cart->qty,
            'total'        => $this->numberFormat($cart->total_sum),
            'weight'       => $this->numberFormat($cart->weight)
        ];
    }

    public function deleteCart(int $product_id, CartRequest $request): array
    {
        Cart::where('cookie_id', $request->cookie('cart'))
            ->where('product_id', $product_id)
            ->delete();

        $cart = $this->getCartTotal();

        return [
            'status' => 0,
            'count'  => $cart->qty,
            'total'  => $this->numberFormat($cart->total_sum),
            'weight' => $this->numberFormat($cart->weight)
        ];
    }

    public function destroy()
    {
        return Cart::where('cookie_id', request()->cookie('cart'))->delete();
    }

    private function getCartTotal()
    {
        return Cart::select(DB::raw('count(*) qty, sum(weight) weight, sum(total_sum) total_sum'))
            ->where('cookie_id', request()->cookie('cart'))
            ->first();
    }

    private function numberFormat($number): string
    {
        return number_format((float)$number, 2, ',', ' ');
    }
}
