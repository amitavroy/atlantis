<?php

namespace App\Traits;

use App\Gallery;
use App\Photo;
use App\Services\Gallery\GalleryService;

trait AlbumTraits
{
    public function getFeaturedImage(Gallery $gallery)
    {
        $metaData = $gallery->meta_data;
        $galleryService = app()->make(GalleryService::class);

        if ($metaData === null) {
            if (isset($gallery->photos[0])) {
                return $galleryService->getPhotoSignedUrls($gallery->photos[0]);
            }
            return [];
        }

        if (isset($metaData['featured'])) {
            $photo = Photo::find($metaData['featured']['id']);
            return $galleryService->getPhotoSignedUrls($photo);
        }
    }
}
