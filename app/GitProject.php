<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GitProject extends Model
{
    protected $guarded = [];
    
    public function setMetaAttribute($value)
    {
        $this->attributes['meta'] = serialize($value);
    }
    
    public function getMetaAttribute($value)
    {
        return unserialize($value);
    }
}
