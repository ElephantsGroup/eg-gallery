<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use elephantsGroup\gallery\models\video;
use elephantsGroup\gallery\models\Album;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model elephantsGroup\gallery\models\Video */
/* @var $form yii\widgets\ActiveForm */

$module_base = \Yii::$app->getModule('base');
$module = \Yii::$app->getModule('gallery');
?>

<div class="video-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'album_id')->dropDownList(ArrayHelper::map(Album::find()->all(), 'id','name'), ['prompt' => $module::t('gallery', 'Select Album ...')]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video_file')->fileInput() ?>

    <?= $form->field($model, 'thumb_file')->fileInput() ?>

    <?= $form->field($model, 'status')->dropDownList(Video::getStatus(), ['prompt' => $module_base::t('Select Status ...')]) ?>

    <?= $form->field($translation, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($translation, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? $module_base::t('Create') : $module_base::t('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
