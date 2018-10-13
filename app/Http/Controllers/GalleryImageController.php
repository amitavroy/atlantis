<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Services\Gallery\GalleryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryImageController extends Controller
{
    public function add(Request $request, GalleryService $galleryService)
    {
        $imageArr = explode(PHP_EOL, $request->input('text'));
        
        $galleryId = $request->input('galleryId');

        $images = collect();

        foreach ($imageArr as $item) {
            if ($item == '') {
                return true;
            }

            $images->push(Photo::create([
                'user_id' => Auth::user()->id,
                'family_id' => Auth::user()->family_id,
                'gallery_id' => $galleryId,
                'path' => "albums/album-{$galleryId}",
                'filename' => $item,
            ]));
        }

        $images->map(function ($photo) use ($galleryService) {
            $photo['signed'] = $galleryService->getPhotoSignedUrls($photo);
            return $photo;
        });

        return response($images, 201);
    }
}
