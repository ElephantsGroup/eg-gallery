<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\VideoTranslation */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Update {modelClass}: ', [
    'modelClass' => 'Video Translation',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Video Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'video_id' => $model->video_id, 'language' => $model->language]];
$this->params['breadcrumbs'][] = $module::t('gallery', 'Update');
?>
<div class="gallery-video-translation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
