<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];

    public function getSlugAttribute()
    {
        return route('gallery.view', $this->id);
    }
}
