<?php

namespace App\Http\Controllers\Admin;


use App\Category;
use App\Components\SiteMapComponent;
use App\Order;
use App\Price;
use App\Product;
use Carbon\Carbon;

class AdminController extends Admin
{
    public function __construct()
    {
        parent::__construct();
        Carbon::setLocale('ru');
    }

    public function index()
    {

        return view('admin.index', [
            'p_count_null' => Product::where('category_id', 0)->count(),
            'p_count' => Product::count('*'),
            'products' => Product::latest()->take(5)->get(),

            'c_count' => Category::count('*'),
            'categories' => Category::latest()->take(5)->get(),

            'o_count' => Order::count('*'),
            'orders' => Order::latest()->take(9)->get(),

            'c_prices' => Price::count('*'),
            'prices' => Price::all()
        ]);
    }

    public function makeSiteMap(SiteMapComponent $component)
    {
        return response()->json([
            'status' => $component->makeSiteMap()
        ]);
    }
}