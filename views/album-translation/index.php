<?php

use yii\helpers\Html;
use yii\grid\GridView;
use elephantsGroup\gallery\models\AlbumTranslation;
use elephantsGroup\gallery\models\Album;
use elephantsGroup\jdf\Jdf;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\gallery\models\AlbumTranslationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Album Translations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-album-translation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($module::t('gallery', 'Create Album Translation'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'album_id',
				'format' => 'raw',
                'filter' => ArrayHelper::map(Album::find()->all(), 'id', 'name'),
                'value' => function ($model) { return Album::findOne($model->album_id)->name; },
            ],
            'language',
            'title',
            'description',
            [
                'attribute' => 'status',
				'format' => 'raw',
                'filter' => AlbumTranslation::getStatus(),
                'value' => function ($model) { return AlbumTranslation::getStatus()[$model->status]; },
            ],
			'sort_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
