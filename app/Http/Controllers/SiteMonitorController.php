<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Http\Request;

class SiteMonitorController extends Controller
{
    public function index()
    {
        $sites = Site::orderBy('name', 'asc')->get();
        return response()->json($sites);
    }
}
