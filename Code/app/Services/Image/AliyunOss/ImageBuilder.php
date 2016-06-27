<?php

namespace App\Services\Image\AliyunOss;


use App\Contracts\Image\ImageBuilder as BaseImageBuilder;

class ImageBuilder extends BaseImageBuilder
{

    protected $style = [];

    /**
     * 设置图片宽度
     * @param $width
     * @return static
     */
    public function setWidth($width)
    {
        $this->style['size']['width'] = $width . 'w';
        return $this;
    }

    /**
     * 设置图片高度
     * @param $height
     * @return static
     */
    public function setHeight($height)
    {
        $this->style['size']['height'] = $height . 'h';
        return $this;
    }

    /**
     * 设置图片质量（百分比）
     * @param $quality
     * @return static
     */
    public function setQuality($quality)
    {
        $this->style['size']['quality'] = $quality . 'Q';
        return $this;
    }

    /**
     * 设置图片文字水印
     * @param $text
     * @param $position
     * @return static
     */
    public function setTextWatermark($text)
    {
        $this->style['watermark2']['watermark'] = 2;
        $this->style['watermark2']['text'] = $this->safeBase64($text);
        return $this;
    }


    /**
     * 设置文字水印位置
     * @param int $position
     * @return static
     */
    public function setTextWatermarkPosition($position = BaseImageBuilder::POSITION_RIGHT_DOWN)
    {
        if ($position !== self::POSITION_RIGHT_DOWN) { //默认参数不添加，以节省总地址长度
            $this->style['watermark2']['p'] = $position;
        }
        return $this;
    }

    /**
     * 设置文字水印文字颜色
     * @param string $color 六位十六进制数字
     * @return static
     */
    public function setTextWatermarkColor($color = '000000')
    {
        if ($color !== '000000') { //默认参数不添加，以节省总地址长度
            $this->style['watermark2']['color'] = $this->safeBase64('#' . $color);
        }
        return $this;
    }

    /**
     * 设置文字水印文字大小(px)，范围(0，1000]
     * @param int $size
     * @return static
     */
    public function setTextWatermarkSize($size = 40)
    {
        if ($size !== '40' && $size > 0 && $size <= 1000) { //默认参数不添加，以节省总地址长度
            $this->style['watermark2']['size'] = $size;
        }
        return $this;
    }

    /**
     * 设置文字水印阴影透明，范围(0,100]
     * @param $shadow
     * @return static
     */
    public function setTextWatermarkShadow($shadow)
    {
        if ($shadow > 0 && $shadow <= 100) {
            $this->style['watermark2']['s'] = $shadow;
        }
        return $this;
    }


    /**
     * 生成处理后的图片地址
     * @return string
     */
    public function generate()
    {
        if (!empty($this->style['size'])) {
            $this->style['size'] = join('_', $this->style['size']);
        }
        if (!empty($this->style['watermark1'])) {
            $this->style['watermark1']['object'] = $this->safeBase64($this->style['watermark1']['object']);
            $this->style['watermark1'] = http_build_query($this->style['watermark1']);
        }
        if (!empty($this->style['watermark2'])) {
            $this->style['watermark2'] = http_build_query($this->style['watermark2']);
        }
        if (!empty($this->style['watermark3'])) {
            $this->style['watermark3']['object'] = $this->safeBase64($this->appendProcess($this->style['watermark3']['object']));
            $this->style['watermark3'] = http_build_query($this->style['watermark3']);
        }

        return empty($this->style) ? $this->src : sprintf('%s@%s', $this->src, join('|', $this->style));
    }

    protected function safeBase64($str)
    {
        $str = base64_encode($str);
        return str_replace(['+', '/', '='], ['-', '_', ''], $str);
    }

    /**
     * 设置图片水印
     * @param $img
     * @return static
     */
    public function setImgWatermark($img)
    {
        $this->style['watermark1']['watermark'] = 1;
        $this->style['watermark1']['object'] = $img; //由于别的操作可能会改这个，所以base64放最后
        return $this;
    }

    /**
     * 基于主图大小，按百分比设置水印图大小
     * @param $percent
     * @return static
     */
    public function setImgWatermarkPercentSizeBaseMainImg($percent)
    {
        $this->style['watermark1']['object'] .= '@' . $percent . 'P';
        return $this;
    }

    public function setImgWatermarkPosition($position = BaseImageBuilder::POSITION_RIGHT_DOWN)
    {
        $this->style['watermark1']['p'] = $position;
        return $this;
    }

    public function setImgWatermarkLocation($x = 10, $y = 10)
    {
        if ($x != 10) {
            $this->style['watermark1']['x'] = $x;
        }
        if (!empty($this->style['watermark1']['p']) && in_array($this->style['watermark1']['p'],
                [self::POSITION_LEFT_MIDDLE, self::POSITION_CENTER_MIDDLE, self::POSITION_RIGHT_MIDDLE])
        ) {
            $this->style['watermark1']['voffset'] = $y;
        } else {
            $this->style['watermark1']['y'] = $y;
        }
        return $this;
    }

    /**
     * 设置图文混排水印
     * @param $text
     * @param $img
     * @return static
     */
    public function setMultiWatermark($text, $img)
    {
        $this->style['watermark3']['watermark'] = 3;
        $this->style['watermark3']['text'] = $this->safeBase64($text);
        $this->style['watermark3']['object'] = $img;
        return $this;
    }

    /**
     * 设置图文混排水印的文字和水印的先后顺序
     * @param int $order
     * @return static
     */
    public function setMultiWatermarkOrder($order = BaseImageBuilder::MULTI_WATERMARK_ORDER_IMAGE_FIRST)
    {
        $this->style['watermark3']['order'] = $order;
        return $this;
    }

    /**
     * 设置图文混排水印文字颜色
     * @param string $color 六位十六进制数字
     * @return static
     */
    public function setMultiWatermarkColor($color = '000000')
    {
        if ($color !== '000000') { //默认参数不添加，以节省总地址长度
            $this->style['watermark3']['color'] = $this->safeBase64('#' . $color);
        }
        return $this;
    }

    /**
     * 设置图文混排水印图片阴影透明
     * @param $shadow
     * @return static
     */
    public function setMultiWatermarkShadow($shadow)
    {
        if ($shadow > 0 && $shadow <= 100) {
            $this->style['watermark3']['s'] = $shadow;
        }
        return $this;
    }

    /**
     * 基于主图大小，按百分比设置水印图大小
     * @param $percent
     * @return static
     */
    public function setMultiWatermarkPercentSizeBaseMainImg($percent)
    {
        $this->style['watermark3']['object'] .= '@' . $percent . 'P';
        return $this;
    }

    /**
     * 设置图文混排水印，图片文字间隔
     * @param $interval
     * @return static
     */
    public function setMultiWatermarkInterval($interval)
    {
        $this->style['watermark3']['interval'] = $interval;
        return $this;
    }

    /**
     * 设置图文混排水印文字大小
     * @param $size
     * @return static
     */
    public function setMultiWatermarkSize($size)
    {
        $this->style['watermark3']['size'] = $size;
        return $this;
    }

    public function setMultiWatermarkPosition($position = BaseImageBuilder::POSITION_RIGHT_DOWN)
    {
        $this->style['watermark3']['p'] = $position;
        return $this;
    }

    public function setMultiWatermarkLocation($x = 10, $y = 10)
    {
        if ($x != 10) {
            $this->style['watermark3']['x'] = $x;
        }
        if ($y != 10) {
            $this->style['watermark3']['y'] = $y;
        }
        return $this;
    }

    public function setMultiWatermarkImgWidth($width)
    {
        $this->style['watermark3']['object'] .= '@' . $width . 'w';
        return $this;
    }

    public function setMultiWatermarkImgHeight($height)
    {
        $this->style['watermark3']['object'] .= '@' . $height . 'h';
        return $this;
    }

    protected function appendProcess($object)
    {
        $index = strpos($object, '@');
        if ($index !== false) {
            return substr($object, 0, $index + 1) . str_replace('@', '_', substr($object, $index + 1));
        } else {
            return $object;
        }
    }
}