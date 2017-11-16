<?php

namespace backend\controllers;

use Yii;
use backend\models\Revision;
use backend\models\Anteproyecto;
use backend\models\RevisionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\data\ArrayDataProvider;


/**
 * RevisionController implements the CRUD actions for Revision model.
 */
class RevisionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
          'access' => [
               'class' => AccessControl::className(),
               'only' => ['create', 'view', 'update', 'delete', 'download', 'seguimiento'],
               'rules' => [
                   [
                       'allow' => true,
                       'actions' => ['view', 'create'],
                       'roles' => [ 'Comite'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['view', 'seguimiento', 'download'],
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
     * Lists all Revision models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RevisionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // seguimiento Estudiante
    public function actionSeguimiento()
    {
         // comienzo
         $searchModel = new RevisionSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $sql = 'SELECT
   		   anteproyecto.nombre, revision.descripcion, revision.correccion, revision.archivo, revision.estado
   		FROM
   		  revision
        INNER JOIN anteproyecto ON anteproyecto.idanteproyecto = revision.idanteproyecto
        WHERE id='.Yii::$app->user->id;

        $result = Yii::$app->db->createCommand($sql)->queryAll();
        // var_dump($result);
        // exit();

          //fin
        return $this->render('seguimiento', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

// download

    public function actionDownload($id)
    {

    $download = Yii::$app->db->createCommand('SELECT  revision.archivo FROM revision WHERE idrevision=:id')
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
     * Displays a single Revision model.
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
     * Creates a new Revision model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Revision();

        if ($model->load(Yii::$app->request->post())) {
          // se obtiene la instacia del archivo subido
          $model->date_create = date('Y-m-d H:m:s');

            $archivo = $model->descripcion;
            $model->file1 = UploadedFile::getInstance($model, 'file1');
            $model->file1->saveAs('Revisiones/'.$archivo.'.'.$model->file->extension );

            // guardando el camino en la Bd columna

            $model->archivo = 'Revisiones/'.$archivo.'.'.$model->file->extension;

            $model->save(false);
            return $this->redirect(['view', 'id' => $model->idrevision]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Revision model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idrevision]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Revision model.
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
     * Finds the Revision model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Revision the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Revision::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
