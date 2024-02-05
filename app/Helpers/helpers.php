<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

function getFormattedDate($date): String
{
    $locale = app()->getLocale();
    Carbon::setLocale($locale);
    $new_date = Carbon::createFromDate($date);
    $new_date_format = $new_date->day . ' ' . $new_date->monthName . ' ' . $new_date->year;
    return $new_date_format;
}

function getFormattedDateHour($date): String
{
    $locale = app()->getLocale();
    Carbon::setLocale($locale);
    $new_date = Carbon::createFromDate($date);
    if (Str::length($new_date->minute) == 1) {
        $prefix = '0';
    } else {
        $prefix = '';
    }
    $new_date_format = $new_date->day . ' ' . $new_date->monthName . ' ' . $new_date->year . ' - ' . $new_date->hour . 'h' . $prefix . $new_date->minute . 'mn';
    return $new_date_format;
}

function gen_code()
{
    return substr(str_shuffle(
        'abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789'
    ), 1, 6);
}

function rmtwochar($chaine) {
    if (strlen($chaine) >= 2) {
        $chaine = substr($chaine, 0, -2);
        return $chaine;
    }
}