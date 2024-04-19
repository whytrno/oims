<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

trait UploadFile
{
    private function uploadFile($file, $path)
    {
        if (gettype($file) == 'object') {
            $imagePath = Storage::put($path, $file);
            $imagePath = asset(str_replace('public/', '', Storage::url($imagePath)));

            return $imagePath;
        } else {
            return $file;
        }
    }
}
