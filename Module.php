<?php

namespace elephantsGroup\gallery;

use Yii;

class Module extends \yii\base\Module
{
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
