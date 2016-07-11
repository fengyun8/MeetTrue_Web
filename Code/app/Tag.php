<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * 获取一个标签下所有的作品集
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function works()
    {
        return $this->belongsToMany('App\Work', 'tag_work', 'work_id', 'tag_id');
    }

    /**
     * 获取所有的作品分类
     * 
     * @param  $query
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function scopeCatelogs($query)
    {
        return $query->where('parent_id', 0)->get();
    }

    /**
     * 获取指定作品分类下标签集
     * 
     * @param  $query
     * @param  $catelog_id [作品分类在Tags表中的id]
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecommendedTag($query, $catelog_id)
    {
        return $query->where('parent_id', $catelog_id);
    }
}
