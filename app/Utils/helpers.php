<?php

if (!function_exists('setActive')) {
    function setActive($path, $class)
    {
        return Request::is($path . '*') ? $class : '';
    }
}

if (!function_exists('dashStats')) {
    function dashStats($dashStats, $key)
    {
        return (isset($dashStats[$key])) ? $dashStats[$key] : '0';
    }
}
