<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{

    public function storeImages($files)
    {
        $imageData = [];

        foreach($files as $file)
        {
            $name = time().'_'.$file->getClientOriginalName();
            Storage::disk('s3')->put($name, file_get_contents($file), 'public');

            $imageUrl = Storage::disk('s3')->url($name);

            $imageData[] = ['image_url' => $imageUrl];
        }

        return $imageData;
    }
}
