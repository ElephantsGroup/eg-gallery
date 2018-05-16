<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use elephantsGroup\gallery\models\Video;
use elephantsGroup\gallery\models\Album;
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
<?php Pjax::begin(); ?>    <?= GridView::widget([
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
<?php Pjax::end(); ?></div>
