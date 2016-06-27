<?php

namespace App\Contracts\Image;


interface Strategy
{
    /**
     * 设置当前环境
     * @param $environment
     * @return mixed
     */
    public function setEnvironment($environment);

    /**
     * 处理图片
     * @param string $src 源图路径
     * @param string|callable $strategy 策略名或回调函数
     * @param mixed ...$params 传递给callback的额外参数
     * @return string 处理后的图片路径
     */
    public function process($src, $strategy, ...$params);

}