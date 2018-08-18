<?php

namespace App\Http\Controllers;

use App\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $expenseType = ExpenseType::where('family_id', Auth::user()->family_id)
            ->orderBy('name', 'asc')
            ->get();

        if (request()->ajax()) {
            return response()->json($expenseType, 200);
        }
    }
}
