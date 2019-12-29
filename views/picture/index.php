<?php

use yii\helpers\Html;
use yii\grid\GridView;
use elephantsGroup\gallery\models\Picture;
use elephantsGroup\gallery\models\PictureTranslation;
use elephantsGroup\gallery\models\Album;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\gallery\models\PictureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Pictures');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-album-pictures-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($module::t('gallery', 'Create Picture'), ['create'], ['class' => 'btn btn-success']) ?>
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
				pictureTranslation::findOne(['picture_id'=>$model->id, 'language'=>$item])
					? Html::a($module::t('gallery', 'Edit'), ['/gallery/picture-translation/update', 'picture_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language]) .
					' / ' . Html::a($module::t('gallery', 'Delete'), ['/gallery/picture-translation/delete', 'picture_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language])
					: Html::a($module::t('gallery', 'Create'), ['/gallery/picture-translation/create', 'picture_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language])
				);
			},
		];

	}

	$columns = [
		['class' => 'yii\grid\SerialColumn'],

		'id',
		'name',
		[
			'attribute' => 'album_id',
			'format' => 'raw',
			'filter' => ArrayHelper::map(Album::find()->all(), 'id', 'name'),
			//'label' => Yii::t('user', 'Role'),
			//'sortable' => true,
			'value' => function ($model) { return Album::findOne($model->album_id)->name; },
		],
		[
			'format' => 'raw',
			'header' => '',
			'value' => function($model) {
				if (isset($model->translations))
				return '<img src="' . Picture::$upload_url . $model->id . '/' . $model->thumb . '"' .
				' width="' . $model->picture_size['thumb']['width'] . '"' .
				' height="' . $model->picture_size['thumb']['height'] . '"' .
				' alt="' . ($model->description ?? $model->name) . '"' .
				' title="' . ($model->title ?? $model->name) . '" />';
			}
		],
		[
			'attribute' => 'status',
			'format' => 'raw',
			'filter' => Picture::getStatus(),
			//'label' => Yii::t('user', 'Role'),
			//'sortable' => true,
			'value' => function ($model) { return Picture::getStatus()[$model->status]; },
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

    <?php /*<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
			[
                'attribute' => 'album_id',
                'value' => function($model){
					return Album::findOne($model->album_id)->name;
				},
				'format' => 'raw',
            ],
            'name',
			[
                'format' => 'raw',
                'header' => '',
                'value' => function($model) { return '<img src="' . Picture::$upload_url . $model->id . '/' . $model->thumb . '" width="200" />'; }
            ],
			[
                'attribute' => 'status',
				'format' => 'raw',
                'filter' => Picture::getStatus(),
                'value' => function ($model) { return Picture::getStatus()[$model->status]; },
            ],
            'sort_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>*/ ?>

</div>
