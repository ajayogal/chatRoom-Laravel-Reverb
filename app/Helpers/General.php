<?php

namespace App\Helpers;

use Carbon\Carbon;

class General
{
    public static function formatDateTime($date, $timezone = 'UTC')
    {
        // Set the default timezone
        date_default_timezone_set($timezone);

        // Create a Carbon object from the provided date
        $dateTime = Carbon::parse($date);

        // Get the current time
        $now = Carbon::now();

        return $dateTime->diffForHumans($now);
    }
}
