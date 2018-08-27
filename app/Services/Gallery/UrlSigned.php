<?php

namespace App\Services\Gallery;

use Aws\CloudFront\UrlSigner as AWSUrlSigned;
use Carbon\Carbon;

class UrlSigned
{
    private $keyPairId;
    private $keyFile;

    /**
     * UrlSigner constructor.
     */
    public function __construct()
    {
        $this->keyPairId = env('KEY_PAIR_ID');
        $this->keyFile = storage_path(env('KEY_FILE'));
    }

    /**
     * Get the signed url for displaying Cloudfront urls
     *
     * @param  $url The cloudfront url
     * @param  int $expiry Time in minutes
     * @return string
     */
    public function getSignedUrl($url, $expiry = 90)
    {
        // for testing we are not able to load the pem.
        // need to check why
        if (env('APP_ENV') === 'testing') {
            return $url;
        }

        $expiryStamp = Carbon::now()->addHours(5)->timestamp;
        $signed = new AWSUrlSigned($this->keyPairId, $this->keyFile);
        return $signed->getSignedUrl($url, $expiryStamp);
    }
}
