<?php

namespace App\Contracts\Image;


abstract class ImageBuilder
{
    const POSITION_LEFT_UP = 1;
    const POSITION_CENTER_UP = 2;
    const POSITION_RIGHT_UP = 3;
    const POSITION_LEFT_MIDDLE = 4;
    const POSITION_CENTER_MIDDLE = 5;
    const POSITION_RIGHT_MIDDLE = 6;
    const POSITION_LEFT_DOWN = 7;
    const POSITION_CENTER_DOWN = 8;
    const POSITION_RIGHT_DOWN = 9;

    protected $src;

    public function __construct($src)
    {
        $this->src = $src;
    }

    /**
     * 设置图片宽度
     * @param $width
     * @return static
     */
    public abstract function setWidth($width);

    /**
     * 设置图片高度
     * @param $height
     * @return static
     */
    public abstract function setHeight($height);

    /**
     * 设置图片质量（百分比）
     * @param $quality
     * @return static
     */
    public abstract function setQuality($quality);

    /**
     * 设置文字水印
     * @param $text
     * @return static
     */
    public abstract function setTextWatermark($text);

    /**
     * 设置文字水印位置
     * @param int $position
     * @return static
     */
    public abstract function setTextWatermarkPosition($position = self::POSITION_RIGHT_DOWN);

    /**
     * 设置文字水印文字颜色
     * @param string $color 六位十六进制数字
     * @return static
     */
    public abstract function setTextWatermarkColor($color = '000000');

    /**
     * 设置文字水印文字大小
     * @param int $size
     * @return static
     */
    public abstract function setTextWatermarkSize($size = 40);

    /**
     * 设置文字水印阴影透明
     * @param $shadow
     * @return static
     */
    public abstract function setTextWatermarkShadow($shadow);

    /**
     * 设置图片水印
     * @param $img
     * @return static
     */
    public abstract function setImgWatermark($img);

    /**
     * 基于主图大小，按百分比设置水印图大小
     * @param $percent
     * @return static
     */
    public abstract function setImgWatermarkPercentSizeBaseMainImg($percent);

    /**
     * 设置图片水印位置
     * @param int $position
     * @return static
     */
    public abstract function setImgWatermarkPosition($position = self::POSITION_RIGHT_DOWN);

    public abstract function setImgWatermarkLocation($x = 10, $y = 10);

    /**
     * 设置图文混排水印
     * @param $text
     * @param $img
     * @return static
     */
    public abstract function setMultiWatermark($text, $img);

    const MULTI_WATERMARK_ORDER_IMAGE_FIRST = 0;
    const MULTI_WATERMARK_ORDER_TEXT_FIRST = 1;

    /**
     * 设置图文混排水印的文字和水印的先后顺序
     * @param int $order
     * @return static
     */
    public abstract function setMultiWatermarkOrder($order = self::MULTI_WATERMARK_ORDER_IMAGE_FIRST);

    /**
     * 设置图文混排水印文字颜色
     * @param string $color 六位十六进制数字
     * @return static
     */
    public abstract function setMultiWatermarkColor($color = '000000');

    /**
     * 设置图文混排水印阴影透明
     * @param $shadow
     * @return static
     */
    public abstract function setMultiWatermarkShadow($shadow);

    /**
     * 基于主图大小，按百分比设置水印图大小
     * @param $percent
     * @return static
     */
    public abstract function setMultiWatermarkPercentSizeBaseMainImg($percent);

    /**
     * 设置图文混排水印，图片文字间隔
     * @param $interval
     * @return static
     */
    public abstract function setMultiWatermarkInterval($interval);

    /**
     * 设置图文混排水印文字大小
     * @param $size
     * @return static
     */
    public abstract function setMultiWatermarkSize($size);

    public abstract function setMultiWatermarkPosition($position = self::POSITION_RIGHT_DOWN);

    public abstract function setMultiWatermarkLocation($x = 10, $y = 10);

    public abstract function setMultiWatermarkImgWidth($width);

    public abstract function setMultiWatermarkImgHeight($height);

    /**
     * 生成处理后的图片地址
     * @return string
     */
    public abstract function generate();
}