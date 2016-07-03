<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * User模型对应users表.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * $fillable中的字段可以使用create和update批量插入或更新.
     *
     * @var array
     */
    protected $fillable = ['nickname', 'last_name','first_name','mobile','email', 'password'];

    /**
     * 返回数据的时候，$hidden中的字段不被返回.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token','token'];


    /************************************ Arrtribute 部分 *************************************/
    public function getNameAttribute()
    {
        // 合并名字
            return $this->last_name . $this->first_name;
    }
}
