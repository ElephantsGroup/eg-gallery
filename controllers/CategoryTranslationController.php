<?php

namespace elephantsGroup\gallery\controllers;

use Yii;
use elephantsGroup\gallery\models\CategoryTranslation;
use elephantsGroup\gallery\models\CategoryTranslationSearch;
//use yii\web\Controller;
use elephantsGroup\base\EGController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryTranslationController implements the CRUD actions for CategoryTranslation model.
 */
class CategoryTranslationController extends EGController
{
    public function behaviors()
	{
		$behaviors = [];
		/*$behaviors['verbs'] = [
			'class' => VerbFilter::className(),
			'actions' => [
				'delete' => ['post'],
			],
		];*/
		return $behaviors;	    
	}

    /**
     * Lists all CategoryTranslation models.
     * @return mixed
     */
     
    public function actionIndex()
    {
        $searchModel = new CategoryTranslationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     /**
     * Displays a single CategoryTranslation model.
     * @param integer $category_id
     * @param string $language
     * @return mixed
     */
    public function actionView($category_id, $language)
    {
        return $this->render('view', [
            'model' => $this->findModel($category_id, $language),
        ]);
    }

    /**
     * Creates a new CategoryTranslation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($category_id, $language, $lang = 'fa-IR')
    {
        $model = new CategoryTranslation();
		$model->category_id = $category_id;
		$model->language = $language;
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			$model->category_id = $category_id;
			$model->language = $language;			
            return $this->redirect(['category/index', 'lang' => $lang]);
        } 
		else 
		{
            return $this->render('create', [
                'model' => $model,
            ]);
			//var_dump($model->errors);
        }
    }

    /**
     * Updates an existing CategoryTranslation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $category_id
     * @param string $language
     * @return mixed
     */
    public function actionUpdate($category_id, $language, $lang = 'fa-IR')
    {
        $model = $this->findModel($category_id, $language);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['category/index', 'lang' => $lang]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CategoryTranslation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $category_id
     * @param string $language
     * @return mixed
     */
    public function actionDelete($category_id, $language, $lang = 'fa-IR')
    {
        $this->findModel($category_id, $language)->delete();

        return $this->redirect(['category/index', 'lang' => $lang]);
    }

    /**
     * Finds the CategoryTranslation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $category_id
     * @param string $language
     * @return CategoryTranslation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($category_id, $language)
    {
        if (($model = CategoryTranslation::findOne(['category_id' => $category_id, 'language' => $language])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
