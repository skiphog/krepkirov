<?php
namespace App\Traits;


trait SessionCart
{
    public function clearCart()
    {
        session()->remove('cart');
        session()->remove('total');
        session()->remove('weight');
        session()->save();
    }

}