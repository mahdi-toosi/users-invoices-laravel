<?php

function persian_number($number)
{
    $persianDigits = [
        '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹',
    ];

    $englishDigits = range(0, 9);

    return str_replace($englishDigits, $persianDigits, $number);
}

function get_months()
{
    return [
        1 => 'فروردین',
        2 => 'اردیبهشت',
        3 => 'خرداد',
        4 => 'تیر',
        5 => 'مرداد',
        6 => 'شهریور',
        7 => 'مهر',
        8 => 'آبان',
        9 => 'آذر',
        10 => 'دی',
        11 => 'بهمن',
        12 => 'اسفند',
    ];
}

function get_month_name($number)
{
    $month = get_months();

    return $month[$number];
}
