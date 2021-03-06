<?php

namespace elephantsGroup\gallery\filters;

use yii\base\ActionFilter;
use yii\web\NotFoundHttpException;

class FrontendFilter extends ActionFilter
{
    public $controllers = ['album' , 'category', 'picture' , 'video', 'album-translation', 'category-translation', 'picture-translation', 'video-translation'];

    public function beforeAction($action)
    {
        if (in_array($action->controller->id, $this->controllers)) {
            throw new NotFoundHttpException('Not found');
        }

        return true;
    }
}
