<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
    public function uploadFile($request, $name, $folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs($folder, $file_name, 'images');
    }

    public function deleteFile($name)
    {
        if (Storage::disk('images')->exists($name)) {
            Storage::disk('images')->deleteDirectory($name);
        }
    }

    public function getImage($file, $name)
    {
        $exists = Storage::disk('images')->exists("$file/$name");
        if ($exists) {
            $content = Storage::get("images/$file/$name");
            //get mime type of image
            $mime = Storage::mimeType("images/$file/$name");
            $response = Response::make($content, 200);
            $response->header("Content-Type", $mime);
            // return response
            return $response;
        }
    }
}
