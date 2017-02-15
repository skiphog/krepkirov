<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use claviska\SimpleImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Image;

class UploadController extends Admin
{

    protected $destination;

    protected $filename;

    protected $files;


    public function upload(Request $request)
    {

        $file = $request->file();

        list($method) = array_keys($file);

        /** @noinspection PhpUndefinedMethodInspection */
        if (!$file[$method]->isValid()) {
            abort(500);
        }

        $this->processUpload($method, $file[$method]);

        return $this->returnResponse();
    }

    public function uploadProductImg(Request $request)
    {

        $img = (new SimpleImage())->fromDataUri($request->input('image'));

        $this->setDirectory();

        $filename = str_random(10);

        $cat = str_replace(config('s.images_path') . '/', '', $this->destination);

        $tmp_file = public_path() . '/images/' . $this->destination . '/' . $filename;

        $img->resize(400, 400)->toFile($tmp_file . '.png')
            ->fromNew(400, 400)
            ->fill('#fff')
            ->overlay($tmp_file . '.png')->toFile($tmp_file . '_400.jpg', null, 100)
            ->thumbnail(100, 100)->toFile($tmp_file . '.jpg', null, 100);

        if (is_file($tmp_file . '.png')) {
            @unlink($tmp_file . '.png');
        }

        return response([
            'status' => 1,
            'file' => '/images/' . config('s.images_path') . '/' . $cat . '/' . $filename . '_400.jpg',
            'input' => $cat . '/' . $filename
        ]);
    }

    protected function processUpload($method, $file)
    {
        $this->setDirectory();

        $this->setFileName();

        $this->$method($file);
    }

    protected function categoryUpload(UploadedFile $file)
    {
        Image::make($file)
            ->fit(config('s.img_width_category'), config('s.img_height_category'))
            ->save(public_path() . '/images/' . $this->destination . '/' . $this->filename);

    }

    private function setDirectory()
    {
        $this->destination = config('s.images_path') . '/' . Carbon::now()->format('md');

        $dir = public_path() . '/images/' . $this->destination;

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
