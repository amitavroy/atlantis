<?php

if (!function_exists('setActive')) {
    function setActive($path, $class)
    {
        return Request::is($path . '*') ? $class : '';
    }
}

if (!function_exists('getProjectName')) {
    function getProjectName($string)
    {
        return ucfirst(str_replace('amitavroy/', '', $string));
    }
}

if (!function_exists('dashStats')) {
    function dashStats($dashStats, $key)
    {
        return (isset($dashStats[$key])) ? $dashStats[$key] : '0';
    }
}

if (!function_exists('getUrls')) {
    function getUrls($url)
    {
        $env = config('app.env');

        if ($env === 'production') {
            return mix($url);
        }

        return asset($url);
    }
}
