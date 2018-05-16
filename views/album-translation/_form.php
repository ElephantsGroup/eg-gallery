<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use elephantsGroup\gallery\models\Album;
use elephantsGroup\gallery\models\AlbumTranslation;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\AlbumTranslation */
/* @var $form yii\widgets\ActiveForm */
$module = \Yii::$app->getModule('gallery');
$module_base = \Yii::$app->getModule('base');
?>

<div class="gallery-album-translation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
		if(!$model->isNewRecord)
			echo $form->field($model, 'language')->dropDownList($module_base->languages, ['prompt' => Yii::t('app', 'Select Languages ...')]);
	?>
	
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? $module::t('gallery', 'Create') : $module::t('gallery', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
