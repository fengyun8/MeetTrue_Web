<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletesTrait;

class Picture extends Model
{
    use SoftDeletesTrait;

    /**
     * 框架属性
     */
    protected $guarded = [];
    protected $dates = ['deleted_at'];
}
