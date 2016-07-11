<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    /**
     * 作品集所属的用户
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * 拿到一个work下面的所有图片
     * 
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    /**
     * 获取该作品集所对应的标签
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_work', 'work_id', 'tag_id');
    }
    
    /**
     * 获取作品集的封面
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cover()
    {
        return $this->belongsTo('App\Image', 'cover_id', 'id');
    }

    /**
     * 该作品集的署名方式
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function copyright()
    {
        return $this->belongsTo('App\Copyright', 'copyright_id', 'id');
    }
}
