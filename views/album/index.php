<?php

use yii\helpers\Html;
use yii\grid\GridView;
use elephantsGroup\gallery\models\Album;
use elephantsGroup\gallery\models\AlbumTranslation;
use elephantsGroup\gallery\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\gallery\models\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Albums');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-album-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($module::t('gallery', 'Create Album'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
	$module = \Yii::$app->getModule('gallery');
	$module_base = \Yii::$app->getModule('base');
	$columns_d = [];
	$language = array_keys($module_base->languages);

	foreach ($language as $item)
	{
		$columns_d [] = [
			'format' => 'raw',
			'label' => $module_base::t($item, 'coding'),
			'value' => function ($model) use($module, $module_base, $item)  {
				return (
				AlbumTranslation::findOne(['album_id'=>$model->id, 'language'=>$item])
					? Html::a($module::t('gallery', 'Edit'), ['/gallery/album-translation/update', 'album_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language]) .
					' / ' . Html::a($module::t('gallery', 'Delete'), ['/gallery/album-translation/delete', 'album_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language])
					: Html::a($module::t('gallery', 'Create'), ['/gallery/album-translation/create', 'album_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language])
				);
			},
		];

	}

	$columns = [
		['class' => 'yii\grid\SerialColumn'],

		'id',
		'name',
		[
			'attribute' => 'category_id',
			'format' => 'raw',
			'filter' => ArrayHelper::map(Category::find()->all(), 'id', 'name'),
			//'label' => Yii::t('user', 'Role'),
			//'sortable' => true,
			'value' => function ($model) { return Category::findOne($model->category_id)->name; },
		],
		[
			'format' => 'raw',
			'header' => '',
			'value' => function($model) { return '<img src="' . Album::$upload_url . $model->id . '/' . $model->logo . '" width="200" />'; }
		],
		[
			'attribute' => 'status',
			'format' => 'raw',
			'filter' => Album::getStatus(),
			//'label' => Yii::t('user', 'Role'),
			//'sortable' => true,
			'value' => function ($model) { return Album::getStatus()[$model->status]; },
		],
		'sort_order',

		['class' => 'yii\grid\ActionColumn'],
	];

	array_splice($columns, 7, 0, $columns_d);
	echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns
    ]); ?>

</div>
