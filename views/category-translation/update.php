<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\CategoryTranslation */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Update Category') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Category Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'category_id' => $model->category_id, 'language' => $model->language]];
$this->params['breadcrumbs'][] = $module::t('gallery', 'Update');
?>
<div class="gallery-category-translation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
