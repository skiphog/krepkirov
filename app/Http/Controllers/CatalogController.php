<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{


    public function index()
    {

        $categories = Category::where('parent_id',0)->get();

        //dd($categories);

        return view('catalog.index',compact('categories'));
    }


    public function show(Category $category)
    {

        $categories = Category::where('parent_id',$category->id)->get();

        $menus = Category::getTreeCategories();

        //dd($category->id,$category->full_url,$menus);
        //dd(strpos('anker/anker-double','bolt') === 0);


        return view('catalog.show',compact('category','categories','menus'));
    }
}
