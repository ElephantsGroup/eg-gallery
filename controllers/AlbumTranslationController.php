<?php

namespace elephantsGroup\gallery\controllers;

use Yii;
use elephantsGroup\gallery\models\AlbumTranslation;
use elephantsGroup\gallery\models\AlbumTranslationSearch;
//use yii\web\Controller;
use elephantsGroup\base\EGController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlbumTranslationController implements the CRUD actions for AlbumTranslation model.
 */
class AlbumTranslationController extends EGController
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
     * Lists all AlbumTranslation models.
     * @return mixed
    
    public function actionIndex()
    {
        $searchModel = new AlbumTranslationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     *
     * Displays a single AlbumTranslation model.
     * @param integer $album_id
     * @param string $language
     * @return mixed
     */
    public function actionView($album_id, $language)
    {
        return $this->render('view', [
            'model' => $this->findModel($album_id, $language),
        ]);
    }

    /**
     * Creates a new AlbumTranslation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($album_id, $language)
    {
        $model = new AlbumTranslation();
		$model->album_id = $album_id;
		$model->language = $language;

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			$model->album_id = $album_id;
			$model->language = $language;
            return $this->redirect(['album/index']);
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
     * Updates an existing AlbumTranslation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $album_id
     * @param string $language
     * @return mixed
     */
    public function actionUpdate($album_id, $language)
    {
        $model = $this->findModel($album_id, $language);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['album/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AlbumTranslation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $album_id
     * @param string $language
     * @return mixed
     */
    public function actionDelete($album_id, $language)
    {
        $this->findModel($album_id, $language)->delete();

        return $this->redirect(['album/index']);
    }

    /**
     * Finds the AlbumTranslation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $album_id
     * @param string $language
     * @return AlbumTranslation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($album_id, $language)
    {
        if (($model = AlbumTranslation::findOne(['album_id' => $album_id, 'language' => $language])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
