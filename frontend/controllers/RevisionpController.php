<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Revisonp;
use frontend\models\RevisionpSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use yii\web\UploadedFile;



/**
 * RevisionpController implements the CRUD actions for Revisonp model.
 */
class RevisionpController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
          'access' => [
               'class' => AccessControl::className(),
               'only' => ['create', 'view', 'update', 'delete'],
               'rules' => [
                   [
                       'allow' => true,
                       'actions' => ['view', 'create', 'update'],
                       'roles' => [ 'Jurado'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['view'],
                       'roles' => ['Estudiante'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['update', 'view'],
                       'roles' => ['Secretario'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['delete'],
                       'roles' => ['Secretario'],
                   ],
               ],
           ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Revisonp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RevisionpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    // download

    public function actionDownload($id)
    {

    $download = Yii::$app->db->createCommand('SELECT  revisonp.archivo FROM revisonp WHERE idrevisonp=:id')
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
     * Displays a single Revisonp model.
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
     * Creates a new Revisonp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Revisonp();

        if ($model->load(Yii::$app->request->post())) {
          $model->num_revisiones = $model->num_revisiones + 1;
          $archivo = $model->descripcion;
          $model->file1 = UploadedFile::getInstance($model, 'file1');
          $model->file1->saveAs('RevisionesP/'.$archivo.'.'.$model->file1->extension );

          // guardando el camino en la Bd columna
          $model->archivo = 'RevisionesP/'.$archivo.'.'.$model->file1->extension;

          $model->save(false);
            return $this->redirect(['view', 'id' => $model->idrevisonp]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Revisonp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->num_revisiones < 3) {

        if ($model->load(Yii::$app->request->post()) ) {
            $model->num_revisiones = $model->num_revisiones + 1;

          $archivo = $model->descripcion;
          $model->file1 = UploadedFile::getInstance($model, 'file1');
          $model->file1->saveAS('RevisionesP/'.$archivo.'.'.$model->file1->extension );

          // guardando el camino en la Bd columna
          $model->archivo = 'RevisionesP/'.$archivo.'.'.$model->file1->extension;

          $model->save(false);
            return $this->redirect(['view', 'id' => $model->idrevisonp]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
      }else {
        \Yii::$app->session->setFlash('warning', 'maximo de revisiones');
        return $this->redirect(['index']);

      }
    }

    /**
     * Deletes an existing Revisonp model.
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
     * Finds the Revisonp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Revisonp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Revisonp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
