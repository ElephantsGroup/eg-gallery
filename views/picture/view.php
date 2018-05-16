<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use elephantsGroup\gallery\models\Picture;
use elephantsGroup\gallery\models\Album;
use elephantsGroup\jdf\Jdf;
	
/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\Picture */
$module = \Yii::$app->getModule('gallery');
$module_base = \Yii::$app->getModule('base');
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Pictures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-album-pictures-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($module::t('gallery', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a($module::t('gallery', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => $module::t('gallery', 'Are you sure you want to delete this item?'),
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
                'value' => Picture::$upload_url . $model->id . '/' . $model->thumb,
                'format' => ['image'],
            ],
			[
                'attribute' => 'picture',
                'value' => Picture::$upload_url . $model->id . '/' . $model->picture,
                'format' => ['image'],
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
				'value'  => Picture::getStatus()[$model->status],
			],
            'sort_order',
        ],
    ]) ?>

</div>
