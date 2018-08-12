<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteRecord extends Model
{
    protected $guarded = [];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
