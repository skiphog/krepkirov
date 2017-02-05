<?php

namespace App\Http\Controllers\Admin;


class AdminController extends Admin
{
    public function index()
    {
        return view('admin.index');
    }
}
