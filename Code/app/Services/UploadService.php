<?php

namespace App\Services;


use Config;
use Storage;

/**
 * 上传服务
 *
 * @package App\Services
 */
class UploadService
{

    /**
     * 上传文件
     * @param $to_path 目标文件夹
     * @param $local_file 本地文件
     * @param null $disk oss / local等
     * @return array
     */
    public static function upload($to_path, $local_file, $disk = null)
    {
        // 存储到 $disk 对应的存储器
        $disk = $disk ?: Storage::getDefaultDriver();
        $success = Storage::disk($disk)->put($to_path, file_get_contents($local_file));

        return [
            'success' => $success,
            'preview_url' => self::generateUrl($disk, $to_path),
            'path' => $disk . ':' . $to_path,
        ];
    }

    /**
     * 解析存入数据库的文件
     *      例子:
     *          oss:201511/o37apxrbjpkhiwvz.jpg => http://images.meet-true.com/default/201511/o37apxrbjpkhiwvz.jpg
     * @param $path 原路径
     * @param null $default 默认值
     * @return null
     */
    public static function parse($path, $default = null)
    {
        // path is empty
        if (empty($path) || !is_string($path) || strpos($path, ':') === false) {
            return $default;
        }

        // parse path
        list($type, $path) = explode(':', $path);
        $url = self::generateUrl($type, $path);

        // return
        return $url ?: $default;
    }

    /**
     * 生成可访问的 url
     * @param $disk 驱动器
     * @param $path 相对路径
     * @return null|string 可访问url
     */
    private static function generateUrl($disk, $path)
    {
        // get upload prefix
        $prefix = Config::get(sprintf('filesystems.disks.%s.prefix', $disk));
        // get urlPrefix
        $key = sprintf('filesystems.disks.%s.url_prefix', $disk);
        $urlPrefix = Config::get($key);

        $urlPrefix = is_callable($urlPrefix) ? $urlPrefix() : $urlPrefix;
        return empty($urlPrefix) ? null : $urlPrefix . '/' . $prefix . $path;
    }
}