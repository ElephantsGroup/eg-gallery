<?php

use elephantsGroup\gallery\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$module_base = \Yii::$app->getModule('base');
$module = \Yii::$app->getModule('gallery');
/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(Category::getStatus(), ['prompt' => $module_base::t('Select Status ...')]) ?>

    <?= $form->field($model, 'logo_file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? $module::t('gallery', 'Create') : $module::t('gallery', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
