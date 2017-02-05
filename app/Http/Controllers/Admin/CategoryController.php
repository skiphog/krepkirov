<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Components\CategoryComponent;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

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
        $this->createCategory(new CategoryComponent($request));

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


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    protected function createCategory(CategoryComponent $component)
    {
        $component->createCategory();
    }
}
