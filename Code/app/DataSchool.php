<?php

namespace App;

use App\Enums\CacheKeyPrefixEnum;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class DataSchool extends Model
{
    /**
     * @var string
     */
    protected $table = 'data_schools';

    protected $guarded = [''];

    /************************ Service 部分 ************************/
    /**
     * Get name by code
     */
    public static function getNameByCode($code)
    {
        if (empty($code)) {
            return null;
        }

        if ($dataSchool = self::where('code', '=', $code)->first()) {
            return $dataSchool->name;
        }
        return null;
    }
}
