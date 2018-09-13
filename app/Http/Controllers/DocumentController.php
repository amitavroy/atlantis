<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $path = 'Documents';

        if ($request->has('path') && $request->input('path') != '') {
            $path = $request->input('path');
        }

        $storage = Storage::disk('s3');
        $directories = $storage->directories($path);
        $files = $storage->files($path);

        return response(['directories' => $directories, 'files' => $files, 'path' => $path], 200);
    }

    public function view(Request $request)
    {
        $file = $request->input('path');
        logger($file);
        $storage = Storage::disk('s3');
        return $storage->download($file);
    }
}
