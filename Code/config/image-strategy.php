<?php

use App\Contracts\Image\ImageBuilder;

return [
    'default' => 'pc',
    'strategies' => [
        'pc' => [
//            'list' => function (ImageBuilder $builder) {
//                return $builder->setWidth(205)->setQuality(80);
//            },
//            'listbanner' => function (ImageBuilder $builder) {
//                return $builder->setWidth(960);
//            },
//            'indexbanner' => function (ImageBuilder $builder) {
//                return $builder->setWidth(980)->setHeight(456);
//            },
//            'content' => function (ImageBuilder $builder, $text) {
//                return $builder->setWidth(960)
//                    ->setMultiWatermark($text, 'default/watermark.png')
//                    ->setMultiWatermarkInterval(4)
//                    ->setMultiWatermarkLocation(24, 20)
//                    ->setMultiWatermarkColor('FFFFFF')->setMultiWatermarkShadow(100)
//                    ->setMultiWatermarkSize(20)
//                    ->setMultiWatermarkImgHeight(26);
////                    ->setTextWatermark($text)->setTextWatermarkColor('FFFFFF')
////                    ->setTextWatermarkSize(30)->setTextWatermarkShadow(100)
////                    ->setImgWatermark('default/watermark.png')
////                    ->setImgWatermarkPercentSizeBaseMainImg(10)->setImgWatermarkLocation(10, 50);
//            },
            'avatar' => function (ImageBuilder $builder) {
                return $builder->setWidth(150)->setQuality(80);
            },
//            'listGallery' => function (ImageBuilder $builder) {
//                return $builder->setWidth(150)->setQuality(80);
//            }
        ],
        'ios' => [

        ],
    ],
];
