<?php

namespace elephantsGroup\gallery\controllers;

use Yii;
use elephantsGroup\gallery\models\Video;
use elephantsGroup\gallery\models\VideoSearch;
use elephantsGroup\gallery\models\VideoTranslation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use elephantsGroup\base\EGController;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends EGController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Video model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Video model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Video();
		$translation = new VideoTranslation();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->video_file = UploadedFile::getInstance($model, 'video_file');
            $model->thumb_file = UploadedFile::getInstance($model, 'thumb_file');
            if($model->save())
            {
				if ($translation->load(Yii::$app->request->post()))
				{
					$translation->video_id = $model->id;
					$translation->language = $this->language;
					if($translation->save())
						return $this->redirect(['view', 'id' => $model->id]);					
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        else
        {
            return $this->render('create', [
                'model' => $model,
				'translation' => $translation,
            ]);
        }
    }

    /**
     * Updates an existing Video model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$translation = VideoTranslation::findOne(array('video_id' => $id, 'language' => $this->language));

        if ($model->load(Yii::$app->request->post()))
        {
            $model->video_file = UploadedFile::getInstance($model, 'video_file');
            $model->thumb_file = UploadedFile::getInstance($model, 'thumb_file');
            if($model->save())
            {
				if ($translation && $translation->load(Yii::$app->request->post()))
				{
					$translation->video_id = $model->id;
					$translation->language = $this->language;
					if($translation->save())
						return $this->redirect(['view', 'id' => $model->id]);					
				}
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
				'translation' => $translation,
            ]);
        }
    }

    /**
     * Deletes an existing Video model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
