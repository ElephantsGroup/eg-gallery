<?php

namespace elephantsGroup\gallery;

use Yii;

class Module extends \yii\base\Module
{
    public $pictureOriginalName = 'original.jpg';
    public $pictureIconName = 'icon.jpg';
    public $pictureIconWidth = 64;
    public $pictureIconHeight = 64;
    public $pictureThumbName = 'thumb.jpg';
    public $pictureThumbWidth = 256;
    public $pictureThumbHeight = 256;
    public $pictureSmallName = 'picture-s.jpg';
    public $pictureSmallWidth = 640;
    public $pictureSmallHeight = 480;
    public $pictureMediumName = 'picture-m.jpg';
    public $pictureMediumWidth = 800;
    public $pictureMediumHeight = 600;
    public $pictureLargeName = 'picture-l.jpg';
    public $pictureLargeWidth = 1024;
    public $pictureLargeHeight = 768;

    public $pictureSize = [];

    public function init()
    {
        parent::init();

        if (empty(Yii::$app->i18n->translations['gallery']))
		{
            Yii::$app->i18n->translations['gallery'] =
			[
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
                //'forceTranslation' => true,
            ];
        }
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t($category, $message, $params, $language);
    }
}
