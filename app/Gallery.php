<?php

namespace App;

use App\Traits\AlbumTraits;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use AlbumTraits;

    protected $guarded = [];

    protected $casts = [
        'meta_data' => 'array',
    ];

    public function getSlugAttribute()
    {
        return route('gallery.view', $this->id);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
