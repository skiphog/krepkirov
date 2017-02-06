<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Image;

class UploadController extends Admin
{

    protected $destination;

    protected $filename;


    public function upload(Request $request)
    {

        $file = $request->file();

        list($method) = array_keys($file);

        if(!$file[$method]->isValid()) {
            abort(500);
        }

        $this->processUpload($method,$file[$method]);

        return $this->returnResponse();
    }

    protected function processUpload($method,$file)
    {
        $this->setDirectory();

        $this->setFileName();

        $this->$method($file);
    }

    protected function categoryUpload(UploadedFile $file)
    {
        $img = Image::make($file)
            ->fit(config('s.img_width_category'),config('s.img_height_category'))
            ->save(public_path() . '/images/'. $this->destination . '/' . $this->filename);

    }

    protected function productUpload(UploadedFile $file)
    {

    }

    private function setDirectory()
    {
        $this->destination = config('s.images_path') . '/' . Carbon::now()->format('md');

        $dir = public_path() . '/images/'. $this->destination;

        if (!@mkdir($dir, 0777, true) && !is_dir($dir)) {
           abort(500);
        }

    }

    private function setFileName()
    {
        $this->filename = str_random(10) . '.png';
    }

    private function returnResponse()
    {
        return response([
            'status' => 1,
            'file_name' => $this->destination . '/' . $this->filename
        ]);
    }
}
