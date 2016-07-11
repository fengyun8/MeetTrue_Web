<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{   
    /**
     * 拿到所有的省集合
     * 
     * @param  $query 
     * @return Illuminate\Database\Eloquent\Builder  [拿到所有的省集合]
     */
    public function scopeProvinces($query)
    {
        return $query->where('parent_id', 0);
    }

    /**
     * 拿到省ID对应的城市集合
     * 
     * @param  $query    
     * @param  Integer $province_id [要查找的省份ID]
     * @return Illuminate\Database\Eloquent\Builder 
     */
    public function scopeCitiesInProvince($query, $province_id)
    {
        return $query->where('parent_id', $province_id);
    }
}
