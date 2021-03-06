<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
