<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    public function events()
    {
        return $this->hasMany(RemindEvent::class);
    }
    
    public function getRepeatAttribute()
    {
        return ucfirst($this->attributes['repeat']);
    }

    public function getTypeAttribute()
    {
        return ucfirst($this->attributes['type']);
    }

    public function getIsActiveAttribute()
    {
        return ($this->attributes['is_active'] === 1) ? 'Active'  : 'In-active';
    }

    public function getReminderDateAttribute()
    {
        if ($this->attributes['repeat'] == 'monthly') {
            return Carbon::parse($this->attributes['reminder_date'])->format('M jS');
        }

        if ($this->attributes['repeat'] == 'yearly') {
            return Carbon::parse($this->attributes['reminder_date'])->format('M jS, Y');
        }

        return 'default';
    }
}
