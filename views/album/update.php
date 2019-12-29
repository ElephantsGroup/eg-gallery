<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\Album */

$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Update Album') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Albums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $module::t('gallery', 'Update');
?>
<div class="gallery-album-update">

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
