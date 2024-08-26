<?php

namespace RsRuman\SalatNotifier\Repositories;

use RsRuman\SalatNotifier\Interfaces\SalatTimeInterface;
use RsRuman\SalatNotifier\Models\SalatTime;

class SalatTimeRepository implements SalatTimeInterface
{
    public function getFajrTime(): string
    {
        return SalatTime::first()->fajr ?? '04:30';
    }

    public function getDhuhrTime(): string
    {
        return SalatTime::first()->dhuhr ?? '13::30';
    }

    public function getAsrTime(): string
    {
        return SalatTime::first()->asr ?? '16:30';
    }

    public function getMaghribTime(): string
    {
        return SalatTime::first()->maghrib ?? '18:45';
    }

    public function getIshaTime(): string
    {
        return SalatTime::first()->isha ?? '20:15';
    }

    public function storeSalatTimes(array $times): void
    {
        SalatTime::updateOrCreate(['id' => 1],
            [
                'fajr'    => $times['fajr'],
                'dhuhr'   => $times['dhuhr'],
                'asr'     => $times['asr'],
                'maghrib' => $times['maghrib'],
                'isha'    => $times['isha'],
            ]
        );
    }
}
