<?php

if (!function_exists('setActive')) {
    function setActive($path, $class)
    {
        return Request::is($path . '*') ? $class : '';
    }
}
