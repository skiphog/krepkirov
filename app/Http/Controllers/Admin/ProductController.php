<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Admin
{

    public function index()
    {
        $menus = Category::getTreeCategories();

        $products = Product::where('category_id', 0)->get();

        return view('admin.products.index', compact('menus', 'products'));
    }

    public function edit(Product $product)
    {
        $categories = Category::getTreeCategories();

        return view('admin.products.edit', compact('product','categories'));
    }

    public function search(Request $request)
    {
        if (($text = $request->input('data')) === '') {
            return $this->getProductsNoCategory();
        }

        $products = Product::select(['products.*', 'categories.title'])
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('name', 'like', '%' . $text . '%')
            ->get();


        return view('admin.products.result_search', compact('products'));
    }

    public function update(Product $product, Request $request)
    {
        $product->update($request->all());

        return back()->with('flash', 'Карточка товара сохранена');
    }

    public function getProductOnCategory(Request $request)
    {
        $products = Product::where('category_id', $request->input('data'))->sort()->get();

        return view('admin.products.sort_form', compact('products'));
    }

    public function saveSortProduct(Request $request)
    {
        foreach ((array)$request->input('product') as $key => $value) {
            Product::where('id', $value)->update(['sort' => $key]);
        }

        return back()->with('flash', 'Сортировка сохранена');
    }

    public function destroy(Request $request)
    {
        return Product::find($request->input('id'));//todo:: Добавить в продакшн  ->delete();
    }

    private function getProductsNoCategory()
    {
        $products = Product::where('category_id', 0)->get();

        return view('admin.products.result_search', compact('products'));
    }
}
