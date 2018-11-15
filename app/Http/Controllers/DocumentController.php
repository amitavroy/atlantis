<?php

namespace App\Http\Controllers;

use App\Services\Document\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * @var DocumentService
     */
    private $documentService;

    /**
     * DocumentController constructor.
     * @param DocumentService $documentService
     */
    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index(Request $request)
    {
        $path = 'Documents';

        if ($request->has('path') && $request->input('path') != '') {
            $path = $request->input('path');
        }

        $response = $this->documentService->getFileAndFolderList($path);

        return response($response, 200);
    }

    public function view(Request $request)
    {
        $file = $request->input('path');
        $storage = Storage::disk('s3');

        return $storage->download($file);
    }

    public function store(Request $request)
    {
        $currentPath = $request->input('currentPath');
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $file->storeAs("{$currentPath}/", $filename, 's3');
        $files = Storage::files($currentPath);

        return response()
            ->json($files, 201);
    }

    public function delete(Request $request)
    {
        $file = $request->input('filePath');
        $currentPath = $request->input('currentPath');

        Storage::disk('s3')->delete($file);

        $response = $this->documentService->getFileAndFolderList($currentPath);

        return response()
            ->json($response, 201);
    }
}
