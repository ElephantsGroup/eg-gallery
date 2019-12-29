<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model elephantsGroup\gallery\models\Video */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Create Video');
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_create', [
        'model' => $model,
		'translation' => $translation,
    ]) ?>

</div>
