<?php

namespace backend\controllers;

use Yii;
use backend\models\Conocimiento;
use backend\models\ConocimientoSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\data\ArrayDataProvider;




/**
 * ConocimientoController implements the CRUD actions for Conocimiento model.
 */
class ConocimientoController extends Controller
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
                       'actions' => ['create', 'view'],
                       'roles' => ['Docente'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['ver'],
                       'roles' => ['Secretario', 'Estudiante', 'Comite'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['delete'],
                       'roles' => ['Secretario'],
                   ],
               ],
           ],

        ];
    }

    /**
     * Lists all Conocimiento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConocimientoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionVer()
    {
        $searchModel = new ConocimientoSearch();
        $sql = Yii::$app->db->createCommand('SELECT  nombre As Titulo, descripcion, telefono, correo FROM  conocimiento ');
        $dataProvider = new ArrayDataProvider([
          'allModels' => $sql->queryAll(),
         ]);

        return $this->render('ver', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Conocimiento model.
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
     * Creates a new Conocimiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Conocimiento();

        if ($model->load(Yii::$app->request->post())) {

          // se obtiene la instacia del archivo subido

            $banco = $model->nombre;
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('banco-proyectos/'.$banco.'.'.$model->file->extension );

            // guardando el camino en la Bd columna

            $model->archivo = 'banco-proyectos/'.$banco.'.'.$model->file->extension ;

            $model->save(false);

            return $this->redirect(['view', 'id' => $model->idconocimiento]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Conocimiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idconocimiento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Conocimiento model.
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
     * Finds the Conocimiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Conocimiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Conocimiento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
