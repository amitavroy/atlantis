<?php

namespace App\Services\Gallery;

use App\Photo;

class GalleryService
{
    /**
     * @var UrlSigned
     */
    private $urlSigned;

    /**
     * GalleryService constructor.
     * @param UrlSigned $urlSigned
     */
    public function __construct(UrlSigned $urlSigned)
    {
        $this->urlSigned = $urlSigned;
    }

    public function getPhotoSignedUrls(Photo $photo)
    {
        $mainUrl = config('atlantis.cdn_url') . $photo['path'] . '/main/' . $photo['filename'];
        $thumbUrl = config('atlantis.cdn_url') . $photo['path'] . '/thumb/' . $photo['filename'];

        return [
            'src' => $this->urlSigned->getSignedUrl($mainUrl),
            'thumb' => $this->urlSigned->getSignedUrl($thumbUrl),
        ];
    }
}
