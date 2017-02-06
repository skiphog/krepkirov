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
        $menus = Category::getTreeCategories();

        $categories = Category::where('parent_id', 0)->get();

        return view('admin.categories.index', compact('menus', 'categories'));

    }


    public function create()
    {
        $categories = Category::getTreeCategories();

        return view('admin.categories.crete', compact('categories'));
    }


    public function store(CategoryRequest $request)
    {
        (new CategoryComponent($request))->createCategory();

        return redirect('/admin')->with('flash', 'Статья создана');
    }


    public function show(Category $category)
    {

    }


    public function edit(Category $category)
    {
        $categories = Category::getTreeCategories();

        return view('admin.categories.edit', compact('category', 'categories'));
    }


    public function update(Category $category, CategoryRequest $request)
    {
        (new CategoryComponent($request))->editCategory($category);

        return redirect('/admin')->with('flash', 'Статья создана');
    }


    public function destroy($id)
    {
        //
    }

    public function saveSortCategory(Request $request)
    {
        foreach ((array)$request->input('category') as $key => $value) {
            Category::where('id', $value)->update(['sort' => $key]);
        }

        return back()->with('flash', 'Сортировка сохранена');
    }

    public function getCategory(Request $request)
    {
        $categories = Category::where('parent_id', $request->input('id'))->get();

        return response()->json([
            'status' => 1,
            'html' => view('admin.categories.cat_form', compact('categories'))->render()
        ]);

    }
}
