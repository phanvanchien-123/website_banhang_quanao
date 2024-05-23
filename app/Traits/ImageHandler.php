<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

trait ImageHandler
{
    /**
     * Upload an image.
     *
     * @param UploadedFile $image
     * @param string $directory
     * @return string
     */
    public function uploadImage(UploadedFile $image, $directory)
    {
        return $image->store($directory, 'public');
    }

    /**
     * Update an image.
     *
     * @param UploadedFile $newImage
     * @param string $currentImagePath
     * @param string $directory
     * @return string
     */
    public function updateImage(UploadedFile $newImage, $currentImagePath, $directory)
    {
        if ($currentImagePath) {
            $this->deleteImage($currentImagePath);
        }

        return $this->uploadImage($newImage, $directory);
    }

    /**
     * Delete an image.
     *
     * @param string $imagePath
     * @return void
     */
    public function deleteImage($imagePath)
    {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
