<?php

namespace App\Http\Controllers;

use App\Models\RemindEvent;
use Illuminate\Support\Facades\Auth;

class RemindEventController extends Controller
{
    public function index()
    {
        $reminderEvents = RemindEvent::where('remind_events.is_active', 1)
            ->join('reminders as r', 'r.id', '=', 'remind_events.reminder_id')
            ->where('r.user_id', Auth::user()->id)
            ->orderBy('remind_events.reminder_at', 'asc')
            ->get();

        return response()->json($reminderEvents, 200);
    }
}
