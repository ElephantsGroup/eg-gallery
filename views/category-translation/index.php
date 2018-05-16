<?php

use yii\helpers\Html;
use yii\grid\GridView;
use elephantsGroup\gallery\models\Category;
use elephantsGroup\gallery\models\CategoryTranslation;
use elephantsGroup\jdf\Jdf;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\gallery\models\CategoryTranslationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$module = \Yii::$app->getModule('gallery');
$this->title = $module::t('gallery', 'Category Translations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-category-translation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($module::t('gallery', 'Create Category Translation'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'category_id',
				'format' => 'raw',
                'filter' => ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                'value' => function ($model) { return Category::findOne($model->category_id)->name; },
            ],
            'language',
            'title',
            [
                'attribute' => 'status',
				'format' => 'raw',
                'filter' => Category::getStatus(),
                //'label' => Yii::t('user', 'Role'),
				//'sortable' => true,
                'value' => function ($model) { return Category::getStatus()[$model->status]; },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
