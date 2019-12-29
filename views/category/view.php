<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use elephantsGroup\gallery\models\Category;
use elephantsGroup\jdf\Jdf;

/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\Category */
$module = \Yii::$app->getModule('gallery');
$module_base = \Yii::$app->getModule('gallery');
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-category-view">

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
                'attribute' => 'status',
                'format' => 'raw',
                'value' => Category::getStatus()[$model->status],
            ],
            [
                'attribute' => 'logo',
                'format' => ['image'],
                'value' => Category::$upload_url . $model->id . '/' . $model->logo,
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
