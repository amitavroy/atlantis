<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('family_id', Auth::user()->family_id)
            ->where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.gallery-index')->with('galleries', $galleries);
    }
}
