<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{


    public function index()
    {

        $categories = Category::where('parent_id', 0)->get();

        return view('catalog.index', compact('categories'));
    }


    public function show(Category $category)
    {

        $categories = Category::where('parent_id', $category->id)->get();

        $menus = Category::getTreeCategories();

        return view('catalog.show', compact('category', 'categories', 'menus'));
    }
}
