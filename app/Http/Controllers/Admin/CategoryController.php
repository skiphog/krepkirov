<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Components\CategoryComponent;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Admin
{

    public function index()
    {
        //
    }


    public function create()
    {
        $categories = Category::getTreeCategories();

        return view('admin.categories.crete',compact('categories'));
    }


    public function store(CategoryRequest $request)
    {
        (new CategoryComponent($request))->createCategory();

        //session()->flash('flash','Статья создана');

       return redirect('/admin'); //->with('flash','Статья создана');
    }


    public function show(Category $category)
    {

    }


    public function edit(Category $category)
    {
        $categories = Category::getTreeCategories();

        return view('admin.categories.edit',compact('category','categories'));
    }


    public function update(Category $category,CategoryRequest $request)
    {
        (new CategoryComponent($request))->editCategory($category);

        //session()->flash('flash','Статья создана');

        return redirect('/admin'); //->with('flash','Статья создана');
    }


    public function destroy($id)
    {
        //
    }
}
