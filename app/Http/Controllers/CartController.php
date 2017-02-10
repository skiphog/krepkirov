<?php

namespace App\Http\Controllers;

use App\Components\CartComponent;
use App\Http\Requests\CartRequest;
use App\Product;


class CartController extends Controller
{

    public function show()
    {
        return view('cart.cart');
    }

    public function change(CartRequest $request)
    {
        /** @var Product $product */
        $product = Product::findOrFail($request->id);

        return (new CartComponent)->changeCart($product, $request->qtw);
    }

    public function clear()
    {
        (new CartComponent())->clearCart();

        return back();
    }


}
