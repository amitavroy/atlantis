<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $guarded = [];

    public function records()
    {
        return $this->hasMany(SiteRecord::class);
    }
}
