<?php

namespace App;

use App\Enums\CacheKeyPrefixEnum;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class DataDict extends Model
{
    /**
     * @var string
     */
    protected $table = 'data_dicts';

    protected $guarded = [''];

    /************************ Service 部分 ************************/
    /**
     * Get name by code
     */
    public static function getValue($type, $code)
    {
        if (empty($type) || empty($code)) {
            return null;
        }

        if ($dataSchool = self::where('dd_type', '=', $type)->where('dd_code', '=', $code)->first()) {
            return $dataSchool->dd_value;
        }
        return null;
    }
}
