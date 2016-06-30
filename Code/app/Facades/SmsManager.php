<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\Sms\SmsManager as LaravelSmsManager;

class SmsManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LaravelSmsManager::class;
    }
}