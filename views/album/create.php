<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\Album */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Create Album');
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Albums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-album-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_create', [
        'model' => $model,
		'translation' => $translation,
    ]) ?>

</div>
