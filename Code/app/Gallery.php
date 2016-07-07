<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletesTrait;

class Gallery extends Model
{
    use SoftDeletesTrait;

    /**
     * 框架属性
     */
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    /**
     * 获取作品集的tags
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_galleries', 'gallery_id', 'tag_id');
    }
}
