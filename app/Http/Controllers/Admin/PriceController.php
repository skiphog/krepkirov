<?php

namespace App\Http\Controllers\Admin;

use App\Price;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Storage;


class PriceController extends Admin
{

    public function __construct()
    {
        parent::__construct();
        Carbon::setLocale('ru');
    }

    public function index()
    {
        $prices = Price::all();

        return view('admin.prices.index', compact('prices'));
    }

    public function upload(Request $request)
    {
        if (!$request->hasFile('files.0') || $request->file('files.0')->extension() !== 'xls') {
            return $this->responseStatus(0);
        }

        $file = $request->file('files.0');

        if (!$price = Price::where('file', $file->getClientOriginalName())->first()) {
            return $this->responseStatus(0);
        }

        if (!Storage::disk('price')->putFileAs('', $file, $price->file)) {
            return $this->responseStatus(0);
        }

        $data = [
            'url' => Storage::disk('price')->url($price->file),
            'size' => Storage::disk('price')->size($price->file),
            'm_date' => Carbon::createFromTimestamp(Storage::disk('price')
                ->lastModified($price->file))
                ->format('Y-m-d H:i:s')
        ];

        $price->update($data);

        return $this->responseStatus(1, [
            'id' => $price->id,
            'name' => $price->name,
            'html' => view('admin.prices.partials_price', compact('price'))->render()
        ]);

    }

    private function responseStatus($status, $html = '')
    {
        return response()->json([
            'status' => $status,
            'res' => $html
        ]);
    }
}
