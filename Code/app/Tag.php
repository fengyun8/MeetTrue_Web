<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * 框架属性
     */
    protected $guarded = [];

    public function galleries()
    {
        $this->belongsToMany('App\Gallery', 'tag_galleries', 'tag_id', 'gallery_id');
    }
}
