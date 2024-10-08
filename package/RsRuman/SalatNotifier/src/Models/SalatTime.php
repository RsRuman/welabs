<?php

namespace RsRuman\SalatNotifier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalatTime extends Model
{
    use HasFactory;

    protected $fillable = ['fajr', 'dhuhr', 'asr', 'maghrib', 'isha'];
}
