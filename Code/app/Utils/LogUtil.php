<?php

namespace App\Utils;

use Log;


/**
 * 自己封装的Log类
 *      1.添加 debugTrace
 *
 * @package App\Utils
 */
class LogUtil
{
    public static function info($message, $params = NULL)
    {
        $params = self::getDebugTrace($params);
        Log::info($message, $params);
    }

    public static function warning($message, $params = NULL)
    {
        $params = self::getDebugTrace($params);
        Log::warning($message, $params);
    }

    public static function error($message, $params = NULL)
    {
        $params = self::getDebugTrace($params);
        Log::error($message, $params);
    }

    /**
     * 添加 debugTrace
     * @param null $params
     * @return null
     */
    public static function getDebugTrace($params = NULL)
    {
        $debugTrace = debug_backtrace();
        $index = 1;

        $params['debug']['file'] = $debugTrace[$index]['file'];
        $params['debug']['line'] = $debugTrace[$index]['line'];

        return $params;
    }
}