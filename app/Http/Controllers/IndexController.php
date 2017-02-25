<?php

namespace App\Http\Controllers;

use App\Category;

class IndexController extends Controller
{

    public function index()
    {
        $categories = Category::limit(12)->inRandomOrder()->get();

        return view('pages.index', compact('categories'));
    }

    public function certificates()
    {
        return view('pages.certificates');
    }

    public function contacts()
    {
        return view('pages.contacts');
    }
}
