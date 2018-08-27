<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Services\Gallery\GalleryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('family_id', Auth::user()->family_id)
            ->with('photos')
            ->where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $galleries->map(function ($gallery) {
            $gallery['slug'] = $gallery->slug;
            return $gallery;
        });

        return view('gallery.gallery-index')->with('galleries', $galleries);
    }

    public function view(Gallery $gallery, GalleryService $galleryService)
    {
        if ($gallery->family_id !== Auth::user()->family_id) {
            $username = Auth::user()->name;
            \Log::warning("User {$username} tried to access some other gallery with id {$gallery->id}");
            abort(404, 'The gallery you are trying to find does not exist');
        }

        $gallery = Gallery::with('photos')->find($gallery->id);

        $gallery->photos->map(function ($photo) use ($galleryService) {
            $photo['signed'] = $galleryService->getPhotoSignedUrls($photo);
            return $photo;
        });

        return view('gallery.gallery-view', compact('gallery'));
    }
}
