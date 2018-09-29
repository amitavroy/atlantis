<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskCommentController extends Controller
{
    public function store(Request $request)
    {
        $postData = $this->validate($request, [
            'comment' => 'required|min:3',
        ]);

        $task = Task::findOrFail($request->input('task_id'));

        $comment = $task->comments()->create([
            'user_id' => Auth::user()->id,
            'family_id' => Auth::user()->family_id,
            'body' => $postData['comment'],
        ]);

        return response($comment, 201);
    }
}
