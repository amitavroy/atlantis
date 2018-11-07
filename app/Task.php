<?php

namespace App;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded= [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
