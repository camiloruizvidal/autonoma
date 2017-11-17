<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Documento;
use frontend\models\DocumentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use yii\web\UploadedFile;

class DocumentoController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel  = new DocumentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel'  => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id),]);
    }

    public function actionDownload($id)
    {

        $download = Yii::$app->db->createCommand('SELECT  documento.archivo FROM documento WHERE iddocumento=:id')
                ->bindValue(':id', $_GET['id'])
                ->queryAll();
        for ($i = 0; $i < count($download); $i++)
        {
            $estado = $download[$i];
        }

        foreach ($estado as $value)
        {

            $path = Yii::getAlias('@webroot') . '/' . $value;

            if (file_exists($path))
            {
                return Yii::$app->response->sendFile($path);
            }
        }
    }

    public function actionCreate()
    {
        $model = new Documento();

        if ($model->load(Yii::$app->request->post()))
        {
            $archivo1       = $model->nombre;
            $model->file    = UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('Archivo/' . $archivo1 . '.' . $model->file->extension);
            $model->archivo = 'Archivo/' . $archivo1 . '.' . $model->file->extension;
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->iddocumento]);
        }
        else
        {
            return $this->renderAjax('create', ['model' => $model,]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['view', 'id' => $model->iddocumento]);
        }
        else
        {
            return $this->render('update', ['model' => $model,]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Documento::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
