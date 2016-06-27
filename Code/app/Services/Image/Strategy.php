<?php

namespace App\Services\Image;


use App\Contracts\Image\Strategy as StrategyContract;
use App\Utils\LogUtil;

abstract class Strategy implements StrategyContract
{
    protected $environment;

    public function __construct()
    {
        $this->environment = config('image-strategy.default');
    }

    /**
     * 设置当前环境
     * @param $environment
     * @return void
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
    }

    protected function convertStrategyToCallback($strategy)
    {
        if (!is_callable($strategy)) {
            return config(sprintf('image-strategy.strategies.%s.%s', $this->environment, $strategy), $strategy);
        } else {
            return $strategy;
        }
    }

    /**
     * 处理图片
     * @param string $src 源图路径
     * @param string|callable $strategy 策略名或回调函数
     * @param mixed ...$params 传递给callback的额外参数
     * @return string 处理后的图片路径
     */
    public function process($src, $strategy, ...$params)
    {
        if (empty($src)) {
            return $src;
        }
        //策略转为callback
        $strategy = $this->convertStrategyToCallback($strategy);

        // 执行Closure
        if (is_callable($strategy)) {
            return $strategy($this->generateImageBuider($src), ...$params)->generate();
        } else {
            // 添加Log
            LogUtil::warning("未配置图片验证规则, 请检查!", ['ImageStrategy' => $strategy]);
            return $src;
        }
    }

    protected abstract function generateImageBuider($src);
}