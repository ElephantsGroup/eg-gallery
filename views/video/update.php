<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model elephantsGroup\gallery\models\Video */

$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Update Video') . ' ' .  $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="video-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
		if($translation)
			echo
				$this->render('_form_update_translate', [
					'model' => $model,
					'translation' => $translation,
				]);
		else
			echo
				$this->render('_form_update', [
					'model' => $model,
				]);
	?>

</div>
