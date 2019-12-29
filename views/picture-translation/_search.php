<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\PictureTranslationSearch */
/* @var $form yii\widgets\ActiveForm */
$module = \Yii::$app->getModule('gallery');
?>

<div class="gallery-picture-translation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'picture_id') ?>

    <?= $form->field($model, 'language') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton($module::t('gallery', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton($module::t('gallery', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
