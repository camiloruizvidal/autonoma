<?php

namespace backend\controllers;

use Yii;
use backend\models\Documento;
use backend\models\DocumentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use yii\web\UploadedFile;

/**
 * DocumentoController implements the CRUD actions for Documento model.
 */
class DocumentoController extends Controller
{
    /**
     * @inheritdoc
     */
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
     * Lists all Documento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
// function download

      public function actionDownload($id)
      {

      $download = Yii::$app->db->createCommand('SELECT  documento.archivo FROM documento WHERE iddocumento=:id')
         ->bindValue(':id', $_GET['id'])
         ->queryAll();
         for ($i=0; $i < count($download); $i++) {
           $estado = $download[$i];
         }

         foreach ($estado as  $value) {

             $path = Yii::getAlias('@webroot').'/'.$value;

      if (file_exists($path)) {
         return Yii::$app->response->sendFile($path);
      }
         }

      }
    /**
     * Creates a new Documento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Documento();

        if ($model->load(Yii::$app->request->post()) ) {
          // se obtiene la instacia del archivo subido

            $archivo1 = $model->nombre;
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('Archivo/'.$archivo1.'.'.$model->file->extension );

            // guardando el camino en la Bd columna

            $model->archivo = 'Archivo/'.$archivo1.'.'.$model->file->extension;

            $model->save(false);
            return $this->redirect(['view', 'id' => $model->iddocumento]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Documento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->iddocumento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Documento model.
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
     * Finds the Documento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
