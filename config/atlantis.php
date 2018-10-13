<?php

return [

    'cdn_url' => env('CDN_URL', ''),

    /**
     * This is the client id that is required by
     * Github Data Fetcher to collect data.
     */
    'git_client' => env('GIT_CLIENT_ID', 'xxxx'),

    /**
     * This is the secret required by
     * Github Data Fetcher to collect data.
     */
    'git_secret' => env('GIT_CLIENT_SECRET', 'yyyy'),

];
