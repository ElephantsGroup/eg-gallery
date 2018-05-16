<?php

use yii\helpers\Html;
use yii\grid\GridView;
use elephantsGroup\gallery\models\Category;
use elephantsGroup\gallery\models\CategoryTranslation;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\gallery\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($module::t('gallery', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
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
				CategoryTranslation::findOne(['category_id'=>$model->id, 'language'=>$item])
					? Html::a($module::t('gallery', 'Edit'), ['/gallery/category-translation/update', 'category_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language]) .
					' / ' . Html::a($module::t('gallery', 'Delete'), ['/gallery/category-translation/delete', 'category_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language])
					: Html::a($module::t('gallery', 'Create'), ['/gallery/category-translation/create', 'category_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language])
				);
			},
		];
	}

	$columns = [
		['class' => 'yii\grid\SerialColumn'],

		'id',
		'name',
		[
			'format' => 'raw',
			'header' => '',
			'value' => function($model) { return '<img src="' . Category::$upload_url . $model->id . '/' . $model->logo . '" width="200" />'; },
		],
		[
			'attribute' => 'status',
			'format' => 'raw',
			'filter' => Category::getStatus(),
			//'label' => Yii::t('user', 'Role'),
			//'sortable' => true,
			'value' => function ($model) { return Category::getStatus()[$model->status]; },
		],

		['class' => 'yii\grid\ActionColumn'],
	];

	array_splice($columns, 5, 0, $columns_d);
	echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>

</div>
