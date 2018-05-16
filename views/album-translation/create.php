<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\AlbumTranslation */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Create Album Translation');
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Album Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-album-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
