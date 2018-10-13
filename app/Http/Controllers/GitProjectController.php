<?php

namespace App\Http\Controllers;

use App\GitProject;
use Illuminate\Http\Request;

class GitProjectController extends Controller
{
    public function list()
    {
        $projects = GitProject::where('sticky', '!=', null)
            ->get();

        return response()->json($projects, 200);
    }
}
