<?php

use Carbon\Carbon;

function getFormattedDate($date): String
{
    Carbon::setLocale('fr');
    $new_date = Carbon::createFromDate($date);
    $new_date_format = $new_date->day . ' ' . $new_date->monthName . ' ' . $new_date->year;
    return $new_date_format;
}

function gen_code()
{
    return substr(str_shuffle(
        'abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789'
    ), 1, 6);
}
