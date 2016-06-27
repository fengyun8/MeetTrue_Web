<?php

namespace App\Services\Image\AliyunOss;


use App\Services\Image\Strategy as BaseStrategy;
use Illuminate\Support\Str;

class Strategy extends BaseStrategy
{

    /**
     * 处理图片
     * @param string $src 源图路径
     * @param string|callable $strategy 策略名或回调函数
     * @param mixed ...$params 传递给callback的额外参数
     * @return string 处理后的图片路径
     */
    public function process($src, $strategy, ...$params)
    {
        //非OSS不处理
        if (!Str::startsWith($src, 'http://images.meet-true.com/')) {
            return $src;
        }

        return parent::process($src, $strategy, ...$params);
    }

    protected function generateImageBuider($src)
    {
        return new ImageBuilder($src);
    }
}