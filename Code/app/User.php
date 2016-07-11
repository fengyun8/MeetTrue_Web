<?php

namespace App;

use App\Enums\CacheKeyPrefixEnum;
use App\Enums\DataDictEnum;
use App\Services\UploadService;
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

    /**
     * 获取用户所在省份
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo('App\Region','province_id', 'id');
    }

    /**
     * 获取用户所在城市
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Region','city_id', 'id');
    }

    /**
     * 获取用户的专业
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function major()
    {
        return $this->belongsTo('App\Major', 'major_id', 'id');
    }

    /**
     * 获取用户所属的学校
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }

    /**
     * 获取用户的所有作品集
     * 
     * @return [type] [description]
     */
    public function works()
    {
        return $this->hasMany('App\Work', 'user_id', 'id');
    }


    public function getRealnameAttribute()
    {
        // 合并名字
        return $this->last_name . $this->first_name;
    }

    public function getAvatarAttribute()
    {
        $default_avatar = asset('images/avatar.jpg');

        // Parse src
        $src = UploadService::parse($this->avatar, $default_avatar);
        return $src;
    }

    public function getBannerAttribute()
    {
        $default_avatar = asset('images/hero-cover.jpg');

        // Parse src
        $src = UploadService::parse($this->banner, $default_avatar);
        return $src;
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
