<?php

namespace elephantsGroup\gallery\filters;

use yii\base\ActionFilter;
use yii\web\NotFoundHttpException;

class BackendFilter extends ActionFilter
{
    public $controllers = ['default'];

    public function beforeAction($action)
    {
        if (in_array($action->controller->id, $this->controllers))
        {
            throw new NotFoundHttpException('Not found');
        }

        return true;
    }
}
