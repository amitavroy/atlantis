<?php

namespace App\Http\Controllers;

use App\GitProject;
use Illuminate\Http\Request;

class GitProjectController extends Controller
{
    public function index()
    {
        $projects = GitProject::orderBy('project_url')->get();

        return view('github.github-index')
            ->with('projects', $projects);
    }

    public function list()
    {
        $projects = GitProject::where('sticky', '!=', null)
            ->get();

        return response()->json($projects, 200);
    }
}
