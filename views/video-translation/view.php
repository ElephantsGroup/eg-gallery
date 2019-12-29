<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use elephantsGroup\gallery\models\Video;
use elephantsGroup\gallery\models\VideoTranslation;
use elephantsGroup\jdf\Jdf;


/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\VideoTranslation */
$module = \Yii::$app->getModule('gallery');
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Video Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-video-translation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($module::t('gallery', 'Update'), ['update', 'video_id' => $model->video_id, 'language' => $model->language], ['class' => 'btn btn-primary']) ?>
        <?= Html::a($module::t('gallery', 'Delete'), ['delete', 'video_id' => $model->video_id, 'language' => $model->language], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => $module::t('gallery', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
	<?php 
	$module_base = \Yii::$app->getModule('base');
	echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
				'attribute'  => 'video_id',
				'value'  => Video::findOne($model->video_id)->name,
			],
            [
				'attribute'  => 'language',
				'value'  => $module_base->languages[$model->language],
				//'filter' => Lookup::items('SubjectType'),
			],            'title',
            'description',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => VideoTranslation::getStatus()[$model->status],
            ],
			'sort_order',
            [
                'format' => 'raw',
                'attribute' => 'creation_time',
                'value' => Jdf::jdate('Y/m/d H:i:s', (new \DateTime($model->creation_time))->getTimestamp(), '', 'Iran', 'en'),
            ],
            [
                'format' => 'raw',
                'attribute' => 'update_time',
                'value' => Jdf::jdate('Y/m/d H:i:s', (new \DateTime($model->update_time))->getTimestamp(), '', 'Iran', 'en'),
            ],
        ],
    ]) ?>

</div>
