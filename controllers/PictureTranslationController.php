<?php

namespace elephantsGroup\gallery\controllers;

use Yii;
use elephantsGroup\gallery\models\PictureTranslation;
use elephantsGroup\gallery\models\PictureTranslationSearch;
//use yii\web\Controller;
use elephantsGroup\base\EGController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PictureTranslationController implements the CRUD actions for PictureTranslation model.
 */
class PictureTranslationController extends EGController
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
     * Lists all PictureTranslation models.
     * @return mixed
     */
    
    public function actionIndex()
    {
        $searchModel = new PictureTranslationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     /**
     * Displays a single PictureTranslation model.
     * @param integer $picture_id
     * @param string $language
     * @return mixed
     */
    public function actionView($picture_id, $language)
    {
        return $this->render('view', [
            'model' => $this->findModel($picture_id, $language),
        ]);
    }

    /**
     * Creates a new PictureTranslation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($picture_id, $language)
    {
        $model = new PictureTranslation();
		$model->picture_id = $picture_id;
		$model->language = $language;

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			$model->picture_id = $picture_id;
			$model->language = $language;
            return $this->redirect(['picture/index']);
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
     * Updates an existing PictureTranslation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $picture_id
     * @param string $language
     * @return mixed
     */
    public function actionUpdate($picture_id, $language)
    {
        $model = $this->findModel($picture_id, $language);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['picture/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PictureTranslation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $picture_id
     * @param string $language
     * @return mixed
     */
    public function actionDelete($picture_id, $language)
    {
        $this->findModel($picture_id, $language)->delete();

        return $this->redirect(['picture/index']);
    }

    /**
     * Finds the PictureTranslation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $picture_id
     * @param string $language
     * @return PictureTranslation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($picture_id, $language)
    {
        if (($model = PictureTranslation::findOne(['picture_id' => $picture_id, 'language' => $language])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
