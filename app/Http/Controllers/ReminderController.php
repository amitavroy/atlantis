<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::where('user_id', Auth::user()->id)
            ->orderBy('reminder_date', 'desc')
            ->get();

        return view('reminder.reminder-index')->withReminders($reminders);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'reminder_date' => 'required|date',
            'title' => 'required',
            'repeat' => 'required',
            'type' => 'required',
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['is_active'] = 1;

        Reminder::create($data);

        return redirect()->back();
    }
}
