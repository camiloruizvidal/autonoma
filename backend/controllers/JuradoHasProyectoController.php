<?php

namespace backend\controllers;

use Yii;
use backend\models\JuradoHasProyecto;
use backend\models\JuradoHasProyectoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;



/**
 * JuradoHasProyectoController implements the CRUD actions for JuradoHasProyecto model.
 */
class JuradoHasProyectoController extends Controller
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
                       'actions' => ['vercomite'],
                       'roles' => [ 'Comite'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['verjurado'],
                       'roles' => ['Estudiante'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['create', 'view'],
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
     * Lists all JuradoHasProyecto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JuradoHasProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JuradoHasProyecto model.
     * @param integer $idjurado
     * @param integer $idproyecto
     * @param integer $idjurado2
     * @return mixed
     */
    public function actionView($idjurado, $idproyecto, $idjurado2)
    {
        return $this->render('view', [
            'model' => $this->findModel($idjurado, $idproyecto, $idjurado2),
        ]);
    }

    /**
     * Creates a new JuradoHasProyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JuradoHasProyecto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idjurado' => $model->idjurado, 'idproyecto' => $model->idproyecto, 'idjurado2' => $model->idjurado2]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionVerjurado()
    {
        $searchModel = new JuradoHasProyectoSearch();
        $sql = Yii::$app->db->createCommand('SELECT  A.nombre AS Jurado, B.nombre AS Jurado2, proyecto.nombre AS Proyecto
           FROM  jurado_has_proyecto
            INNER JOIN jurado A ON A.idjurado = jurado_has_proyecto.idjurado
            INNER JOIN jurado B ON B.idjurado = jurado_has_proyecto.idjurado2
            INNER JOIN proyecto ON proyecto.idproyecto = jurado_has_proyecto.idproyecto
            WHERE  id='.Yii::$app->user->id);
        $dataProvider = new ArrayDataProvider([
          'allModels' => $sql->queryAll(),
         ]);

        return $this->render('verjurado', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing JuradoHasProyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idjurado
     * @param integer $idproyecto
     * @param integer $idjurado2
     * @return mixed
     */
    public function actionUpdate($idjurado, $idproyecto, $idjurado2)
    {
        $model = $this->findModel($idjurado, $idproyecto, $idjurado2);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idjurado' => $model->idjurado, 'idproyecto' => $model->idproyecto, 'idjurado2' => $model->idjurado2]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing JuradoHasProyecto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idjurado
     * @param integer $idproyecto
     * @param integer $idjurado2
     * @return mixed
     */
    public function actionDelete($idjurado, $idproyecto, $idjurado2)
    {
        $this->findModel($idjurado, $idproyecto, $idjurado2)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JuradoHasProyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idjurado
     * @param integer $idproyecto
     * @param integer $idjurado2
     * @return JuradoHasProyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idjurado, $idproyecto, $idjurado2)
    {
        if (($model = JuradoHasProyecto::findOne(['idjurado' => $idjurado, 'idproyecto' => $idproyecto, 'idjurado2' => $idjurado2])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
