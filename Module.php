<?php

namespace elephantsGroup\gallery;

use Yii;

class Module extends \yii\base\Module
{
    public $pictureIconName = 'icon.jpg';
    public $pictureIconWidth = 80;
    public $pictureIconHeight = 80;
    public $pictureLargName = 'picture-l.jpg';
    public $pictureLargWidth = 540;
    public $pictureLargHeight = 540;
    public $pictureMediumName = 'picture-m.jpg';
    public $pictureMediumWidth = 220;
    public $pictureMediumHeight = 220;

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
