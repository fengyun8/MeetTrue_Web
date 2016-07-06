<?php

namespace App;

use App\Enums\CacheKeyPrefixEnum;
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
    public function getANameAttribute()
    {
        // 合并名字
        return $this->last_name . $this->first_name;
    }

    /**
     * 获取手机
     * aMobile
     */
    public function getAMobileAttribute()
    {
        // 手机不可见
        if ($this->mobile_visiable == 0) {
            // 登陆且是自己
            if (!empty(auth()->user()) && auth()->user()->id == $this->id) {
                return $this->mobile;
            }
            return '';
        }

        return $this->mobile;
    }

    /**
     * 获取邮箱
     * aEmail
     */
    public function getAEmailAttribute()
    {
        // 邮箱不可见
        if ($this->email_visiable == 0) {
            // 登陆且是自己
            if (!empty(auth()->user()) && auth()->user()->id == $this->id) {
                return $this->email;
            }
            return '';
        }

        return $this->email;
    }

    /**
     * 这里只给需判断绑定邮箱的地方用
     * 值说明:
     *      null: email为空
     *      true: email待验证
     *      email: 存在email
     */
    public function getBindEmailAttribute()
    {
        if (empty($this->email)) {
            $isBindEmail = \Cache::get(CacheKeyPrefixEnum::IS_BIND_MAIL . $this->id);
            if (empty($isBindEmail)) {
                return null;
            }

            return true;
        }

        return $this->email;
    }

    /************************ Service 部分 ************************/
    /**
     * update by userId
     */
    public static function updateByUserId($userId, $params)
    {
        return \App\User::whereId($userId)->update($params);
    }
}
