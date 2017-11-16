<?php

namespace backend\controllers;

use Yii;
use backend\models\DirectorProyectoPorProyecto;
use backend\models\FormSearch;
use backend\models\DirectorProyectoPorProyectoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
use mPDF;



/**
 * DirectorProyectoPorProyectoController implements the CRUD actions for DirectorProyectoPorProyecto model.
 */
class DirectorProyectoPorProyectoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
          'access' => [
               'class' => AccessControl::className(),
               'only' => ['create', 'view', 'delete'],
               'rules' => [
                   [
                       'allow' => true,
                       'actions' => ['create', 'view'],
                       'roles' => [ 'Secretario'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['view'],
                       'roles' => ['Estudiante'],
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
     * Lists all DirectorProyectoPorProyecto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DirectorProyectoPorProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DirectorProyectoPorProyecto model.
     * @param integer $iddirector_proyecto
     * @param integer $idproyecto
     * @return mixed
     */
    public function actionView($iddirector_proyecto, $idproyecto)
    {
        return $this->render('view', [
            'model' => $this->findModel($iddirector_proyecto, $idproyecto),
        ]);
    }

    /**
     * Creates a new DirectorProyectoPorProyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DirectorProyectoPorProyecto();

        if ($model->load(Yii::$app->request->post()) ) {
          $model->fecha = date('Y-m-d H:m:s');
          $model->save();
            return $this->redirect(['view', 'iddirector_proyecto' => $model->iddirector_proyecto, 'idproyecto' => $model->idproyecto]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    // reportante

    public function actionReportdir()
    {
        $table = new DirectorProyectoPorProyecto;
        $model = $table->find()->all();

        $form = new FormSearch;
        $search = null;
        if($form->load(Yii::$app->request->get()))
        {
            if ($form->validate())
            {
                $search = Html::encode($form->fechaini);
                $search1 = Html::encode($form->fechafin);
                $search2 = Html::encode($form->q);
                // var_dump($search1);
                // exit();
                $query = "SELECT proyecto.nombre AS Proyecto, director_proyecto.nombre AS Director, director_proyecto_por_proyecto.fecha AS Fecha
                FROM director_proyecto_por_proyecto
                INNER JOIN proyecto ON  proyecto.idproyecto = director_proyecto_por_proyecto.idproyecto
                INNER JOIN director_proyecto ON  director_proyecto.iddirector_proyecto = director_proyecto_por_proyecto.iddirector_proyecto
                WHERE director_proyecto.iddirector_proyecto LIKE '%$search2%' AND  fecha between   '$search' AND  '$search1'";
                //$query .= "Nombre LIKE '%$search%' OR Apellido LIKE '%$search%'";
                $model = $table->findBySql($query)->all();
                $mPDF1 = new \Mpdf\Mpdf(); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
                $mPDF1->useOnlyCoreFonts = true;
                $mPDF1->SetTitle("Director de proyectos - Reporte");
                $mPDF1->SetAuthor("Autnoma");
                $mPDF1->SetWatermarkText("Autonoma");
                $mPDF1->showWatermarkText = true;
                $mPDF1->watermark_font = 'DejaVuSansCondensed';
                $mPDF1->watermarkTextAlpha = 0.1;
                $mPDF1->SetDisplayMode('fullpage');
                $mPDF1->WriteHTML($this->renderPartial('reportpdf', ['model'=>$model], true)); //hacemos un render partial a una vista preparada, en este caso es la vista pdfReport
                $mPDF1->Output('director_proyecto'.date('YmdHis'),'I');  //Nombre del pdf y parámetro para ver pdf o descargarlo directamente.
                exit;
            }
            else
            {
                $form->getErrors();
            }
        }
        return $this->render("reportdir", [
          "model" => $model,
          "form" => $form,
          "search" => $search,

          ]);
    }

    /**
     * Updates an existing DirectorProyectoPorProyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $iddirector_proyecto
     * @param integer $idproyecto
     * @return mixed
     */
    public function actionUpdate($iddirector_proyecto, $idproyecto)
    {
        $model = $this->findModel($iddirector_proyecto, $idproyecto);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'iddirector_proyecto' => $model->iddirector_proyecto, 'idproyecto' => $model->idproyecto]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DirectorProyectoPorProyecto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $iddirector_proyecto
     * @param integer $idproyecto
     * @return mixed
     */
    public function actionDelete($iddirector_proyecto, $idproyecto)
    {
        $this->findModel($iddirector_proyecto, $idproyecto)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DirectorProyectoPorProyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $iddirector_proyecto
     * @param integer $idproyecto
     * @return DirectorProyectoPorProyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($iddirector_proyecto, $idproyecto)
    {
        if (($model = DirectorProyectoPorProyecto::findOne(['iddirector_proyecto' => $iddirector_proyecto, 'idproyecto' => $idproyecto])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
