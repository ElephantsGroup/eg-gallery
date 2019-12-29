<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use elephantsGroup\gallery\models\Picture;
use elephantsGroup\gallery\models\Album;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\Picture */
/* @var $form yii\widgets\ActiveForm */
$module = \Yii::$app->getModule('gallery');
$module_base = \Yii::$app->getModule('base');
?>

<div class="gallery-album-pictures-form">

     <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'album_id')->dropDownList(ArrayHelper::map(Album::find()->all(), 'id','name'), ['prompt' => $module::t('gallery', 'Select Album ...')]) ?>

    <?= $form->field($model, 'name')->textInput() ?>

	<?= $form->field($model, 'picture_file')->fileInput() ?>

    <?= $form->field($model, 'thumb_file')->fileInput() ?>

    <?= $form->field($model, 'status')->dropDownList(Picture::getStatus(), ['prompt' => $module_base::t('Select Status ...')]) ?>

    <?= $form->field($translation, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($translation, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? $module_base::t('Create') : $module_base::t('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
