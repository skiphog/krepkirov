<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Components\CartDb;
use App\Http\Requests\CartRequest;

class CartController extends Controller
{
    public function show()
    {
        $cart = Cart::select(
            ['products.id', 'products.name', 'products.price_1', 'carts.qty', 'carts.weight','carts.total_sum'])
            ->where('cookie_id', request()->cookie('cart'))
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->get()
            ->toArray();

        return view('cart.cart', compact('cart'));
    }

    public function change(CartRequest $request, CartDb $cart)
    {
        /** @var Product $product */
        $product = Product::findOrFail($request->id);

        return $cart->changeCart($product, $request);
    }

    public function clear(CartDb $cart)
    {
        $cart->destroy();

        return back();
    }
}
