<?php

namespace RsRuman\SalatNotifier\Interfaces;

interface SalatTimeInterface
{
    public function getFajrTime(): string;
    public function getDhuhrTime(): string;
    public function getAsrTime(): string;
    public function getMaghribTime(): string;
    public function getIshaTime(): string;
    public function storeSalatTimes(array $times): void;
}
