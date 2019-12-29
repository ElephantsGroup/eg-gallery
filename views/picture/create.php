<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\Picture */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Create Picture');
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Pictures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-album-pictures-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_create', [
        'model' => $model,
		'translation' => $translation,
    ]) ?>

</div>
