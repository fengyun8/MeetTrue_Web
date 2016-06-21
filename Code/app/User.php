<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

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
    protected $fillable = ['nickname', 'last_name','first_name','phone','email', 'password'];

    /**
     * 返回数据的时候，$hidden中的字段不被返回.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
}
