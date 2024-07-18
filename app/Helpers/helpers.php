<?php

use Carbon\Carbon;

if (!function_exists('dateFormat')) {
    function dateFormat($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }
}

if (!function_exists('timeFormat')) {
    function timeFormat($date)
    {
        return \Carbon\Carbon::parse($date)->format('H\hi\m\i\n');
    }
}
