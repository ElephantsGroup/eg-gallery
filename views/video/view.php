<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use elephantsGroup\gallery\models\Video;
use elephantsGroup\gallery\models\Album;
use elephantsGroup\jdf\Jdf;


/* @var $this yii\web\View */
/* @var $model elephantsGroup\gallery\models\Video */

$gallery_base = Yii::$app->getModule('base');
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($gallery_base::t('Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a($gallery_base::t('Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute'  => 'album_id',
                'value'  => Album::findOne($model->album_id)->name,
            ],
            [
                'attribute' => 'thumb',
                'value' => Video::$upload_url . $model->id . '/' . $model->thumb,
                'format' => ['image'],
            ],
            [
                'attribute' => 'video',
                'value' => '<video width="100%" controls>' .
                                '<source src ="' . Video::$upload_url . $model->id . '/' . $model->video . '" type="video/mp4">' .
                            '</video>',
                'format' => ['raw'],
            ],
            [
                'attribute'  => 'creation_time',
                'value'  => Jdf::jdate('Y/m/d H:i:s', (new \DateTime($model->creation_time))->getTimestamp(), '', 'Iran', 'en'),
            ],
            [
                'attribute'  => 'update_time',
                'value'  => Jdf::jdate('Y/m/d H:i:s', (new \DateTime($model->update_time))->getTimestamp(), '', 'Iran', 'en'),
            ],
            [
                'attribute'  => 'status',
                'value'  => Video::getStatus()[$model->status],
            ],
            'sort_order',
        ],
    ]) ?>

</div>
