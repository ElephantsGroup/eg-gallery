<?php

namespace elephantsGroup\gallery\controllers;

use Yii;
use elephantsGroup\gallery\models\Album;
use elephantsGroup\gallery\models\Picture;
use elephantsGroup\gallery\models\PictureSearch;
use elephantsGroup\gallery\models\PictureTranslation;
//use yii\web\Controller;
use elephantsGroup\base\EGController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PictureController implements the CRUD actions for Picture model.
 */
class PictureController extends EGController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Picture models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PictureSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Picture model.
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
     * Creates a new Picture model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Picture();
		$translation = new PictureTranslation();

        if ($model->load(Yii::$app->request->post())) 
		{
			$model->picture_file = UploadedFile::getInstance($model, 'picture_file');
            $model->thumb_file = UploadedFile::getInstance($model, 'thumb_file');
            if($model->save())
            {
				if ($translation->load(Yii::$app->request->post()))
				{
					$translation->picture_id = $model->id;
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
     * Updates an existing Picture model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$translation = PictureTranslation::findOne(array('picture_id' => $id, 'language' => $this->language));

        if ($model->load(Yii::$app->request->post()))
		{
            $model->picture_file = UploadedFile::getInstance($model, 'picture_file');
            $model->thumb_file = UploadedFile::getInstance($model, 'thumb_file');
            if($model->save())
            {
				if ($translation && $translation->load(Yii::$app->request->post()))
				{
					$translation->picture_id = $model->id;
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
     * Deletes an existing Picture model.
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
     * Finds the Picture model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Picture the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Picture::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
