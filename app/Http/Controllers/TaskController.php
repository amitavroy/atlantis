<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where(function ($query) {
            $query->where('is_complete', 0);
            $query->where('user_id', Auth::user()->id);
        })->orderBy('created_at', 'desc')->get();

        return view('task.task-index')->with('tasks', $tasks);
    }

    public function store(Request $request)
    {
        $data =$this->validate($request, [
            'description' => 'required|min:3',
        ]);

        $data['user_id'] = Auth::user()->id;

        Task::create($data);

        flash('Your task is created.')->success();
        return redirect()->route('task.index');
    }
}
