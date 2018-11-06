<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RemindEvent extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    public function reminder()
    {
        return $this->belongsTo(Reminder::class)
            ->where('user_id', Auth::user()->id);
    }
}
