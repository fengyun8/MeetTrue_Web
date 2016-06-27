<?php

namespace App\Facades;

use App\Contracts\Image\Strategy as StrategyContract;
use Illuminate\Support\Facades\Facade;

class ImageStrategy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return StrategyContract::class;
    }
}
