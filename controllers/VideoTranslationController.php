<?php

namespace elephantsGroup\gallery\controllers;

use Yii;
use elephantsGroup\gallery\models\VideoTranslation;
use elephantsGroup\gallery\models\VideoTranslationSearch;
//use yii\web\Controller;
use elephantsGroup\base\EGController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VideoTranslationController implements the CRUD actions for VideoTranslation model.
 */
class VideoTranslationController extends EGController
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
     * Lists all VideoTranslation models.
     * @return mixed
     */
    
    public function actionIndex()
    {
        $searchModel = new VideoTranslationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     /**
     * Displays a single VideoTranslation model.
     * @param integer $video_id
     * @param string $language
     * @return mixed
     */
    public function actionView($video_id, $language)
    {
        return $this->render('view', [
            'model' => $this->findModel($video_id, $language),
        ]);
    }

    /**
     * Creates a new VideoTranslation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($video_id, $language)
    {
        $model = new VideoTranslation();
		$model->video_id = $video_id;
		$model->language = $language;

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			$model->video_id = $video_id;
			$model->language = $language;
            return $this->redirect(['video/index']);
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
     * Updates an existing VideoTranslation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $video_id
     * @param string $language
     * @return mixed
     */
    public function actionUpdate($video_id, $language)
    {
        $model = $this->findModel($video_id, $language);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['video/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing VideoTranslation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $video_id
     * @param string $language
     * @return mixed
     */
    public function actionDelete($video_id, $language)
    {
        $this->findModel($video_id, $language)->delete();

        return $this->redirect(['video/index']);
    }

    /**
     * Finds the VideoTranslation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $video_id
     * @param string $language
     * @return VideoTranslation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($video_id, $language)
    {
        if (($model = VideoTranslation::findOne(['video_id' => $video_id, 'language' => $language])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
