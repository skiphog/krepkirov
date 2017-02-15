<?php

namespace App\Http\Controllers\Admin;

use Storage;

class PriceController extends Admin
{

    public function index()
    {

        dump(Storage::disk('price')->files());

        foreach(Storage::disk('price')->files() as $file) {
            dump($file);
        }

    }
}
