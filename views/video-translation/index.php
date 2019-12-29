<?php

use yii\helpers\Html;
use yii\grid\GridView;
use elephantsGroup\gallery\models\VideoTranslation;
use elephantsGroup\gallery\models\Video;
use elephantsGroup\jdf\Jdf;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\gallery\models\VideoTranslationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Video Translations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-video-translation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($module::t('gallery', 'Create Video Translation'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'video_id',
				'format' => 'raw',
                'filter' => ArrayHelper::map(Video::find()->all(), 'id', 'name'),
                'value' => function ($model) { return Video::findOne($model->video_id)->name; },
            ],
            'language',
            'title',
            'description',
            [
                'attribute' => 'status',
				'format' => 'raw',
                'filter' => VideoTranslation::getStatus(),
                'value' => function ($model) { return VideoTranslation::getStatus()[$model->status]; },
            ],
			'sort_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
