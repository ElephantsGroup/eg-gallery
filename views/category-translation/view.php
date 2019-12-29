<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use elephantsGroup\gallery\models\CategoryTranslation;
use elephantsGroup\gallery\models\Category;
use elephantsGroup\jdf\Jdf;

/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\CategoryTranslation */
$module = \Yii::$app->getModule('gallery');
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $module::t('gallery', 'Category Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-category-translation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($module::t('gallery', 'Update'), ['update', 'category_id' => $model->category_id, 'language' => $model->language], ['class' => 'btn btn-primary']) ?>
        <?= Html::a($module::t('gallery', 'Delete'), ['delete', 'category_id' => $model->category_id, 'language' => $model->language], [
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
				'attribute'  => 'category_id',
				'value'  => Category::findOne($model->category_id)->name,
			],
            [
				'attribute'  => 'language',
				'value'  => $module_base->languages[$model->language],
			],
            'title',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => CategoryTranslation::getStatus()[$model->status],
            ],
            [
                'format' => 'raw',
                'attribute' => 'creation_time',
                'value' => Jdf::jdate('Y/m/d H:i:s', (new \DateTime($model->creation_time))->getTimestamp(), '', 'Iran', 'en'),
            ],
            [
                'format' => 'raw',
                'attribute' => 'update_time',
                'value' => Jdf::jdate('Y/m/d H:i:s', (new \DateTime($model->update_time))->getTimestamp(), '', 'Iran', 'en')
            ],
        ],
    ]) ?>

</div>
