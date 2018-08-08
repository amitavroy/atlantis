<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param DashboardService $dashboardService
     * @return \Illuminate\Http\Response
     */
    public function index(DashboardService $dashboardService)
    {
        if (Auth::guest()) {
            return redirect('/');
        }

        $dashData = $dashboardService->getDashboardData();

        return view('home')->with('dashData', $dashData);
    }
}
