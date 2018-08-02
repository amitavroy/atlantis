<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.profile-index')
            ->with('user', Auth::user());
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'password' => 'nullable|min:6',
            'confirm_password' => 'same:password|required_with:password',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');

        if ($request->has('confirm_password')) {
            $user->password = bcrypt($request->input('confirm_password'));
        }

        $user->save();

        flash('User profile saved');

        return redirect(route('profile.index'));
    }
}
