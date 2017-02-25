<?php

namespace App\Http\Controllers;


use App\Price;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Price::all();

        return view('pages.price', compact('prices'));
    }
}
