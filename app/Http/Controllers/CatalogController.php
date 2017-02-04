<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{


    public function show(Category $category)
    {

        $categories = Category::where('parent_id',$category->id)->get();

        $menus = Category::getTreeCategories();

        dd($category->id,$category->full_url,$menus);


        return view('catalog.show',compact('category','categories','menus'));
    }
}
