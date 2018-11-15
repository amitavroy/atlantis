<?php

namespace App\Services\Document;

use Illuminate\Support\Facades\Storage;

class DocumentService
{
    public function getFileAndFolderList($path = null)
    {
        if ($path == null) {
            $path = 'Documents';
        }

        $storage = Storage::disk('s3');
        $directories = $storage->directories($path);
        $files = $storage->files($path);

        return ['directories' => $directories, 'files' => $files, 'path' => $path];
    }
}
