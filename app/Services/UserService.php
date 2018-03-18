<?php

namespace App\Services;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * Upload profile image
     *
     * @param mixed $image
     * @return string
     */
    public function uploadProfileImage($image)
    {
        $image = Image::make($image);

        $filename = time() .'.'. explode('/', $image->mime)[1];

        $path = config('admin.storage.paths.profile_images');

        if( ! Storage::exists($path) ){
            Storage::makeDirectory($path);
        }

        $image->fit(400, 400)->save( storage_path("app/$path/$filename") );

        return $filename;
    }
}