<?php

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $products = Product::select(['categories.full_url', 'categories.img', 'categories.title'])
            ->where('name', 'like', '%' . $request->input('search') . '%')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('products.category_id')
            ->limit(20)
            ->get()
            ->toArray();

        foreach ($products as &$product) {
            //$product['name'] = trim(preg_replace('~\d+[xXхХ]+\d+\s*|[мМmM]+\d+|-~u', '', $product['name']));
            //$product['img'] = $product['image'] ? 'catalog/' . $product['image'] . '.jpg' : $product['img'];
            $product['title'] = str_limit($product['title'], 25);
        }

        unset($product);

        return response()->json(['results' => $products]);
    }
}
