<?php

namespace elephantsGroup\gallery\controllers;

use Yii;
//use yii\web\Controller;
use elephantsGroup\gallery\models\Category;
use elephantsGroup\gallery\models\CategoryTranslation;
use elephantsGroup\gallery\models\Album;
use elephantsGroup\gallery\models\AlbumTranslation;
use elephantsGroup\gallery\models\Picture;
use elephantsGroup\stat\models\Stat;
use elephantsGroup\base\EGController;
use elephantsGroup\jdf\Jdf;

class DefaultController extends EGController
{
    public function actionIndex($lang = 'fa-IR')
    {
		Stat::setView('event', 'default', 'index');

        //$this->layout = '//creative-item';
		Yii::$app->controller->addLanguageUrl('fa-IR', Yii::$app->urlManager->createUrl(['gallery', 'lang' => 'fa-IR']), (Yii::$app->controller->language !== 'fa-IR'));
		Yii::$app->controller->addLanguageUrl('en', Yii::$app->urlManager->createUrl(['gallery', 'lang' => 'en']), (Yii::$app->controller->language !== 'en'));

        $category = [];
        $category = Category::find()->all();
        $gallery = [];
        foreach($category as $cat)
        {
            $cat_tarnslate = CategoryTranslation:: find()->select('title')->where(['category_id' => $cat->id, 'language'=>$lang])->one();
            if($cat_tarnslate)
                $cat_name = $cat_tarnslate->title;
            else
                $cat_name = $cat->name;

            $gallery[$cat->name] = [
                'title' => $cat_name,
                'albums' => [],
            ];

            foreach($cat->albums as $al)
            {
                $al_tarnslate = AlbumTranslation:: find()->select('title')->where(['album_id' => $al->id, 'language'=>$lang])->one();
                if($al_tarnslate)
                    $al_name = $al_tarnslate->title;
                else
                    $al_name = $al->name;

                $gallery[$cat->name]['albums'][$al_name] = [
                    'id' => $al->id,
                    'logo' => Album::$upload_url . $al->id . '/' . $al->logo,
                    'pictures' => [],
                ];
                foreach($al->pictures as $pic)
                {
                    $gallery[$cat->name]['albums'][$al_name]['pictures'][] = [
                        Picture::$upload_url . $pic->id . '/' . $pic->name,
                    ];
                }
            }
        }

        return $this->render('index',[
            'gallery' => $gallery,
			'language' => $this->language
		]);
    }

    public function actionView($id, $lang = 'fa-IR')
    {
        //$this->layout = '//creative-item';
		Yii::$app->controller->addLanguageUrl('fa-IR', Yii::$app->urlManager->createUrl(['gallery/default/view', 'id'=>$id, 'lang' => 'fa-IR']), (Yii::$app->controller->language !== 'fa-IR'));
		Yii::$app->controller->addLanguageUrl('en', Yii::$app->urlManager->createUrl(['gallery/default/view', 'id'=>$id, 'lang' => 'en']), (Yii::$app->controller->language !== 'en'));

        $picture = [];
        $album = AlbumTranslation::find()->select(['title', 'album_id'])->where(['album_id' => $id])->one();
        $pictures = Picture::find()->where(['album_id' => $id])->all();
        foreach ($pictures as $pic)
        {
            $picture [] = [
                'thumb' => Picture::$upload_url . $pic->id . '/' . $pic->thumb,
                'picture' => Picture::$upload_url . $pic->id . '/' . $pic->picture,
            ];
        }


        return $this->render('view', [
            'picture' => $picture,
            'album' => $album,
        ]);
    }
}
