<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use elephantsGroup\gallery\models\Album;
use elephantsGroup\jdf\Jdf;
use elephantsGroup\gallery\models\Category;
/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\Album */
$module = \Yii::$app->getModule('gallery');
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Albums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-album-view">

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
				'attribute'  => 'category_id',
				'value'  => Category::findOne($model->category_id)->name,
			],
            [
                'attribute' => 'logo',
                'format' => ['image'],
                'value' => Album::$upload_url . $model->id . '/' . $model->logo,
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => Album::getStatus()[$model->status],
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
