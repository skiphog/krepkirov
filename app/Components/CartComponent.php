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

        session()->put('total', $this->totalSum('sum'));
        session()->put('weight', $this->totalSum('weight'));

        return [
            'status' => 1,
            'sum' => $this->numberFormat($this->param['sum']),
            'count' => count(session('cart')),
            'total' => $this->numberFormat(session('total')),
            'small_weight' => $this->numberFormat($this->param['weight']),
            'weight' => $this->numberFormat(session('weight'))
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
            session()->put('total', $this->totalSum('sum'));
            session()->put('weight', $this->totalSum('weight'));
            $total = session('total');
            $weight = session('weight');
        }

        session()->save();

        return [
            'status' => 0,
            'count' => count(session('cart')),
            'total' => $this->numberFormat($total),
            'weight' => $this->numberFormat($weight)
        ];
    }

    private function numberFormat($number)
    {
        return number_format((float)$number, 2, ',', ' ');
    }

    private function totalSum($item)
    {
        return array_sum(array_column(session('cart'), $item));
    }


}