<?php

namespace App\Http\ViewComposers;

use App\Cart;
use DB;
use Illuminate\View\View;

class CartComposer
{
    public function compose(View $view)
    {
        $cart = Cart::select(DB::raw('count(*) cnt, sum(weight) weight, sum(total_sum) total_sum'))
            ->where('cookie_id', request()->cookie('cart'))
            ->first();

        $view->with(compact('cart'));
    }
}