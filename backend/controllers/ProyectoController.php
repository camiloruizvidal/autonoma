<?php

namespace backend\controllers;

use Yii;
use backend\models\Proyecto;
use backend\models\FormSearch;
use backend\models\ProyectoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use mPDF;

/**
 * ProyectoController implements the CRUD actions for Proyecto model.
 */
class ProyectoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
               'class' => AccessControl::className(),
               'only' => ['create', 'view', 'update', 'verproyecto', 'delete'],
               'rules' => [
                   [
                       'allow' => true,
                       'actions' => ['view'],
                       'roles' => [ 'Comite'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['create', 'view', 'verproyecto'],
                       'roles' => ['Estudiante'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['update', 'view', 'download'],
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
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReportpro()
    {
        $table = new proyecto;
        $model = $table->find()->all();

        $form = new FormSearch;
        $search = null;
        if($form->load(Yii::$app->request->get()))
        {
            if ($form->validate())
            {
                $search = Html::encode($form->fechaini);
                $search1 = Html::encode($form->fechafin);
                //$search2 = Html::encode($form->q);
                // var_dump($search1);
                // exit();
                $query = "SELECT proyecto.nombre, user.nombre AS Estudiante, proyecto.descripcion, date_create
                FROM proyecto
                INNER JOIN user ON  user.id = proyecto.id
                WHERE   date_create between  '$search' AND  '$search1'";
                //$query .= "Nombre LIKE '%$search%' OR Apellido LIKE '%$search%'";
                $model = $table->findBySql($query)->all();
                $mPDF1 = new \Mpdf\Mpdf(); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
                $mPDF1->useOnlyCoreFonts = true;
                $mPDF1->SetTitle("proyectos - Reporte");
                $mPDF1->SetAuthor("Autonoma");
                $mPDF1->SetWatermarkText("Autonoma");
                $mPDF1->showWatermarkText = true;
                $mPDF1->watermark_font = 'DejaVuSansCondensed';
                $mPDF1->watermarkTextAlpha = 0.1;
                $mPDF1->SetDisplayMode('fullpage');
                $mPDF1->WriteHTML($this->renderPartial('reportpdf', ['model'=>$model], true)); //hacemos un render partial a una vista preparada, en este caso es la vista pdfReport
                $mPDF1->Output('proyectos'.date('YmdHis'),'I');  //Nombre del pdf y parámetro para ver pdf o descargarlo directamente.
                exit;
            }
            else
            {
                $form->getErrors();
            }
        }
        return $this->render("reportpro", [
          "model" => $model,
          "form" => $form,
          "search" => $search,

          ]);
    }

    public function actionVerproyecto()
        {
            $searchModel = new ProyectoSearch();
            $sql = Yii::$app->db->createCommand('SELECT  proyecto.nombre, proyecto.descripcion, proyecto.archivo_proyecto , director_proyecto.nombre AS Director FROM director_proyecto, director_proyecto_por_proyecto, proyecto WHERE director_proyecto.iddirector_proyecto = director_proyecto_por_proyecto.iddirector_proyecto AND id='.Yii::$app->user->id);

            $dataProvider = new ArrayDataProvider([
              'allModels' => $sql->queryAll(),
             ]);

            return $this->render('verproyecto', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }



    /**
     * Displays a single Proyecto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // download actionDownload
   public function actionDownload()
   {

      $params = [':id' => $_GET['id']];

      //$download = Anteproyecto::findOne($id);
      $download = Yii::$app->db->createCommand('SELECT  proyecto.archivo_proyecto FROM proyecto WHERE idproyecto=:id')
          ->bindValues($params)
          ->queryOne();
      // var_dump($download);
          foreach ($download as  $value) {
              // var_dump($value);
              $path = Yii::getAlias('@webroot').'/'.$value;

      if (file_exists($path)) {
          return Yii::$app->response->sendFile($path);
      }
          }

   }


    /**
     * Creates a new Proyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
           $model = new Proyecto();

           if ($model->load(Yii::$app->request->post()) ) {
             $model->date_create = date('Y-m-d H:m:s');
             $model->id = Yii::$app->user->id;
             $archivo = $model->nombre;
           $model->file = UploadedFile::getInstance($model, 'file');
           $model->file->saveAs('proyecto/'.$archivo.'.'.$model->file->extension );

           // guardando el camino en la Bd columna

           $model->archivo_proyecto = 'proyecto/'.$archivo.'.'.$model->file->extension ;

           $model->save(false);
               return $this->redirect(['view', 'id' => $model->idproyecto]);
           } else {
               return $this->renderAjax('create', [
                   'model' => $model,
               ]);
           }


     }

    /**
     * Updates an existing Proyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idproyecto]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Proyecto model.
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
     * Finds the Proyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proyecto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
