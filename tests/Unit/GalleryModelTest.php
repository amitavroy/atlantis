<?php

namespace Tests\Unit;

use App\Gallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_gallery_will_have_a_slug()
    {
        $gallery = factory(Gallery::class)->create();
        $expected = url("personal/gallery/{$gallery->id}");
        $this->assertEquals($expected, $gallery->slug);
    }
}
