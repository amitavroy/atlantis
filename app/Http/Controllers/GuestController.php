<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function welcome()
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        return redirect(route('home'));
    }
}
