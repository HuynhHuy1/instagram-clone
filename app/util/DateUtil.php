<?php

namespace App\util;

use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Support\Carbon;

class DateUtil
{
    public static function formatTimestamp($timestamp)
    {
        $formatter = "Y-m-d H:i:s";

        $dateTime = Carbon::createFromFormat($formatter, $timestamp);

        $currentDateTime = Carbon::now();
        $duration = $dateTime->diff($currentDateTime);
        if ($duration->d > 1) {
            return $duration->d . " ngày trước";
        } else if ($duration->h > 1) {
            return $duration->h . " giờ trước";
        } else if ($duration->i === 0) {
            return "vừa mới đăng";
        } else {
            return $duration->i . " phút trước";
        }
    }
}
