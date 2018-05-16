<?php

use yii\helpers\Html;
use yii\grid\GridView;
use elephantsGroup\gallery\models\Picture;
use elephantsGroup\gallery\models\Album;

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
            /*[
                'format' => 'raw',
                'header' => '',
                'value' => function($model) { return '<img src="' . Picture::$upload_url . $model->id . '/' . $model->picture . '" width="200" />'; }
            ],*/
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
    ]); ?>

</div>
