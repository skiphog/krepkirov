<?php

namespace App\Components;


use App\Product;
use App\Traits\SessionCart;

class CartComponent
{
    use SessionCart;

    protected $param = [];


    public function changeCart(Product $product, int $qty)
    {
        if ($qty === 0) {
            return $this->deleteCart($product->id);
        }

        $this->param = $product->unit === 'тыс. шт' ? [
            'sum' => $product->price_1 * $qty / 1000,
            'unit' => 'шт',
            'weight' => (float)$product->weight * $qty / 1000
        ] : [
            'sum' => $product->price_1 * $qty,
            'unit' => $product->unit,
            'weight' => (float)$product->weight * $qty
        ];

        return $this->addCart($product, $qty);
    }

    public function addCart(Product $product, $qty)
    {

        session()->put('cart.' . $product->id, [
            'image' => $product->image,
            'name' => $product->name,
            'price' => $product->price_1,
            'weight' => $this->param['weight'],
            'unit' => $this->param['unit'],
            'qty' => $qty,
            'sum' => $this->param['sum']
        ]);

        session()->put('total', array_sum(array_column(session('cart'), 'sum')));
        session()->put('weight', array_sum(array_column(session('cart'), 'weight')));

        return [
            'status' => 1,
            'sum' => number_format((float)$this->param['sum'], 2, ',', ' '),
            'count' => count(session('cart')),
            'total' => number_format((float)session('total'), 2, ',', ' '),
            'small_weight' => number_format((float)$this->param['weight'], 2, ',', ' '),
            'weight' => number_format((float)session('weight'), 2, ',', ' ')
        ];
    }

    public function deleteCart($id)
    {
        session()->remove('cart.' . $id);

        if (empty(session('cart'))) {
            session()->remove('total');
            session()->remove('weight');
            $total = $weight = 0;
        } else {
            session()->put('total', array_sum(array_column(session('cart'), 'sum')));
            session()->put('weight', array_sum(array_column(session('cart'), 'weight')));
            $total = session('total');
            $weight = session('weight');
        }

        session()->save();

        return [
            'status' => 0,
            'count' => count(session('cart')),
            'total' => number_format((float)$total, 2, ',', ' '),
            'weight' => number_format((float)$weight, 2, ',', ' ')
        ];
    }


}