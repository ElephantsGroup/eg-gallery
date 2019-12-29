<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use elephantsGroup\gallery\models\Video;
use elephantsGroup\gallery\models\VideoTranslation;
use elephantsGroup\gallery\models\Album;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel elephantsGroup\gallery\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$modulde_base = Yii::$app->getModule('base');
$modulde = Yii::$app->getModule('gallery');
$this->title = $modulde::t('gallery', 'Videos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($modulde::t('gallery', 'Create Video'), ['create'], ['class' => 'btn btn-success']) ?>
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
				VideoTranslation::findOne(['video_id'=>$model->id, 'language'=>$item])
					? Html::a($module::t('gallery', 'Edit'), ['/gallery/video-translation/update', 'video_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language]) .
					' / ' . Html::a($module::t('gallery', 'Delete'), ['/gallery/video-translation/delete', 'video_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language])
					: Html::a($module::t('gallery', 'Create'), ['/gallery/video-translation/create', 'video_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language])
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
			'value' => function($model) { return '<img src="' . Video::$upload_url . $model->id . '/' . $model->thumb . '" width="200" />'; }
		],
		[
			'attribute' => 'status',
			'format' => 'raw',
			'filter' => Video::getStatus(),
			//'label' => Yii::t('user', 'Role'),
			//'sortable' => true,
			'value' => function ($model) { return Video::getStatus()[$model->status]; },
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

<?php /*<?php Pjax::begin(); ?>
<?= GridView::widget([
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
            //video,
            [
                'format' => 'raw',
                'header' => '',
                'value' => function($model) { return '<img src="' . Video::$upload_url . $model->id . '/' . $model->thumb . '" width="200" />'; }
            ],
            'sort_order',
[
                'attribute' => 'status',
                'value' => function($model){
                    return Video::getStatus()[$model->status];
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', Video::getStatus(), ['class' => 'form-control', 'prompt' => $modulde_base::t('Select Status ...')])
            ],
            //'update_time',
            //'creation_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>*/ ?>

</div>