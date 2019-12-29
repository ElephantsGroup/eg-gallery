<?php

use yii\helpers\Html;
use yii\grid\GridView;
use elephantsGroup\gallery\models\PictureTranslation;
use elephantsGroup\gallery\models\Picture;
use elephantsGroup\jdf\Jdf;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\gallery\models\PictureTranslationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Picture Translations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-picture-translation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($module::t('gallery', 'Create Picture Translation'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'picture_id',
				'format' => 'raw',
                'filter' => ArrayHelper::map(Picture::find()->all(), 'id', 'name'),
                'value' => function ($model) { return Picture::findOne($model->picture_id)->name; },
            ],
            'language',
            'title',
            'description',
            [
                'attribute' => 'status',
				'format' => 'raw',
                'filter' => PictureTranslation::getStatus(),
                'value' => function ($model) { return PictureTranslation::getStatus()[$model->status]; },
            ],
			'sort_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
