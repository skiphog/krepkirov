<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

class CatalogController extends Controller
{


    public function index()
    {
        //dd(session()->all());

        $categories = Category::where('parent_id', 0)->get();

        return view('catalog.index', compact('categories'));
    }


    public function show(Category $category)
    {
        $menus = Category::getTreeCategories();
        $categories = Category::where('parent_id', $category->id)->get();
        $products = Product::where('category_id', $category->id)->sort()->get();

        return view('catalog.show', compact('category', 'menus', 'categories', 'products'));
    }
}
