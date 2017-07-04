<?php

namespace App\Components;

use App\Product;

class CartCookie
{
    public function changeCart(Product $product, int $qty)
    {
        if ($qty === 0) {
            return $this->deleteCart($product->id);
        }
        $params = $this->initProduct($product, $qty);

        return $this->addCart($product, $params, $qty);
    }

    public function addCart(Product $product, array $params, int $qty)
    {
        $cart = $this->getCookieCart();

        $cart[$product->id] = $this->makeCartItem($product, $params, $qty);
        $total = $this->makeTotal($cart);

        return $this->returnResponse($cart, $params, $total);
    }

    public function deleteCart($id): array
    {
        session()->remove('cart.' . $id);


        if (empty(session('cart'))) {
            session()->remove('total');
            session()->remove('weight');
            $total = $weight = 0;
        } else {
            session()->put('total', $this->totalSum('sum'));
            session()->put('weight', $this->totalSum('weight'));
            $total = session('total');
            $weight = session('weight');
        }

        session()->save();

        return [
            'status' => 0,
            'count'  => count(session('cart')),
            'total'  => $this->numberFormat($total),
            'weight' => $this->numberFormat($weight)
        ];
    }

    private function numberFormat($number): string
    {
        return number_format((float)$number, 2, ',', ' ');
    }

    private function totalSum(array $array, $item)
    {
        return array_sum(array_column($array, $item));
    }

    private function initProduct(Product $product, int $qty): array
    {
        return $product->unit === 'тыс. шт' ? [
            'sum'    => $product->price_1 * $qty / 1000,
            'unit'   => 'шт',
            'weight' => (float)$product->weight * $qty / 1000
        ] : [
            'sum'    => $product->price_1 * $qty,
            'unit'   => $product->unit,
            'weight' => (float)$product->weight * $qty
        ];
    }

    private function returnResponse(array $cart, array $params, array $total)
    {
        return response()->json([
            'status'       => 1,
            'sum'          => $this->numberFormat($params['sum']),
            'count'        => $total['count'],
            'total'        => $this->numberFormat($total['total']),
            'small_weight' => $this->numberFormat($params['weight']),
            'weight'       => $this->numberFormat($total['weight'])
        ])->cookie('cart', json_encode($cart), 10080)
            ->cookie('total', $total['total'], 10080)
            ->cookie('weight', $params['weight'], 10080);
    }

    private function makeCartItem(Product $product, $params, $qty): array
    {
        return [
            'image'  => $product->image,
            'name'   => $product->name,
            'price'  => $product->price_1,
            'weight' => $params['weight'],
            'unit'   => $params['unit'],
            'qty'    => $qty,
            'sum'    => $params['sum']
        ];
    }

    private function makeTotal(array $cart): array
    {
        return [
            'total'  => $this->totalSum($cart, 'sum'),
            'weight' => $this->totalSum($cart, 'weight'),
            'count'  => count($cart)
        ];
    }

    private function getCookieCart(): array
    {
        $cart = request()->cookie('cart');

        return empty($cart) ? [] : json_decode($cart,true);
    }
}