<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\VideoTranslation */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Create Video Translation');
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Video Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-video-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
