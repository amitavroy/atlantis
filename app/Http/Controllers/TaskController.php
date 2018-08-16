<?php

namespace App\Http\Controllers;

use App\Events\Task\TaskCreatedEvent;
use App\Events\Task\TaskDeletedEvent;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

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
        $data = $this->validate($request, [
            'description' => 'required|min:3',
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['family_id'] = Auth::user()->family_id;

        $task = Task::create($data);

        Event::dispatch(new TaskCreatedEvent($task));

        flash('Your task is created.')->success();
        return redirect()->route('task.index');
    }

    public function remove(Request $request)
    {
        $id = $request->input('task_id');

        $task = Task::find($id);

        if (!$task) {
            abort(400, 'Bad request. Task not found');
        }

        if ($task->user_id != Auth::user()->id) {
            abort(401, 'You are not allowed to delete this task');
        }

        if (!$task->delete()) {
            abort(400, 'Bad request. Task was not deleted.');
        }

        Event::dispatch(new TaskDeletedEvent($id));

        return response([], 200);
    }
}
