<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RemindEvent extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];
}
