<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\Category */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_create', [
        'model' => $model,
		'translation' => $translation,
    ]) ?>

</div>
