<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Authors:
 * - François B
 * - Andre Polykanine A.K.A. Menelion Elensúlë
 * - JD Isaacks
 */
return [
    'year' => ':count năm',
    'a_year' => '{1}một năm|]1, Inf[:count năm',
    'y' => ':count năm',
    'month' => ':count tháng',
    'a_month' => '{1}một tháng|]1, Inf[:count tháng',
    'm' => ':count tháng',
    'week' => ':count tuần',
    'a_week' => '{1}một tuần|]1, Inf[:count tuần',
    'w' => ':count tuần',
    'day' => ':count ngày',
    'a_day' => '{1}một ngày|]1, Inf[:count ngày',
    'd' => ':count ngày',
    'hour' => ':count giờ',
    'a_hour' => '{1}một giờ|]1, Inf[:count giờ',
    'h' => ':count giờ',
    'minute' => ':count phút',
    'a_minute' => '{1}một phút|]1, Inf[:count phút',
    'min' => ':count phút',
    'second' => ':count giây',
    'a_second' => '{1}vài giây|]1, Inf[:count giây',
    's' => ':count giây',
    'ago' => ':time trước',
    'from_now' => ':time tới',
    'after' => ':time sau',
    'before' => ':time trước',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM [năm] YYYY',
        'LLL' => 'D MMMM [năm] YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM [năm] YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Hôm nay lúc] LT',
        'nextDay' => '[Ngày mai lúc] LT',
        'nextWeek' => 'dddd [tuần tới lúc] LT',
        'lastDay' => '[Hôm qua lúc] LT',
        'lastWeek' => 'dddd [tuần trước lúc] LT',
        'sameElse' => 'L',
    ],
    'meridiem' => ['SA', 'CH'],
    'months' => ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
    'months_short' => ['Thg01', 'Thg02', 'Thg03', 'Thg04', 'Thg05', 'Thg06', 'Thg07', 'Thg08', 'Thg09', 'Thg10', 'Thg11', 'Thg12'],
    'weekdays' => ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],
    'weekdays_short' => ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
    'weekdays_min' => ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' và '],
];