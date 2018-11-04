<?php

namespace App;

use App\Models\SiteRecord;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $guarded = [];

    public function records()
    {
        return $this->hasMany(SiteRecord::class);
    }
}
