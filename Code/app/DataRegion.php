<?php

namespace App;

use App\Enums\CacheKeyPrefixEnum;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class DataRegion extends Model
{
    /**
     * @var string
     */
    protected $table = 'data_regions';

    protected $guarded = [''];

    /************************ Service 部分 ************************/
}
