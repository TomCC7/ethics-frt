<?php

namespace App\Handlers;

use Illuminate\Support\Str;

class ImageUploadHandler
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function save($file, $folder, $file_prefix)
    {
        // foldername
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        // get the real store path
        $upload_path = public_path() . '/' . $folder_name;

        // get the extension of the file
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // create the file name
        $filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        // if not a picuture, terminate the function
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // move the picture to the path
        $file->move($upload_path, $filename);

        //return the path
        return [
            'path' => config('app.url') . "/$folder_name/$filename"
        ];
    }
}
