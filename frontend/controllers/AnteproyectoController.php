<?php
// importante ver cap 24 para obtener y llenar datos de BD a un formulario
namespace frontend\controllers;

use Yii;
use frontend\models\Anteproyecto;
use frontend\models\FormSearch;
use frontend\models\AnteproyectoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use yii\web\UploadedFile;
use yii\helpers\Html;
use mPDF;


/**
 * AnteproyectoController implements the CRUD actions for Anteproyecto model.
 */
class AnteproyectoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
          'access' => [
               'class' => AccessControl::className(),
               'only' => ['create', 'view', 'update', 'delete', 'download','vercomite'],
               'rules' => [
                   [
                       'allow' => true,
                       'actions' => ['vercomite', 'download', 'view'],
                       'roles' => [ 'Comite'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['create', 'view', 'update'],
                       'roles' => ['Estudiante'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['view','update', 'download'],
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
     * Lists all Anteproyecto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnteproyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // action pdf reporte

    public function actionReportante()
    {
        $table = new anteproyecto;
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
                $query = "SELECT anteproyecto.nombre, user.nombre AS Estudiante, anteproyecto.descripcion, date_create, modalidad.nombre AS Modalidad
                FROM anteproyecto
                INNER JOIN modalidad ON  modalidad.idmodalidad = anteproyecto.idmodalidad
                INNER JOIN user ON  user.id = anteproyecto.id
                WHERE modalidad.idmodalidad LIKE '%$search2%' AND  date_create between  '$search' AND  '$search1'";
                //$query .= "Nombre LIKE '%$search%' OR Apellido LIKE '%$search%'";
                $model = $table->findBySql($query)->all();
                $mPDF1 = new \Mpdf\Mpdf(); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
                $mPDF1->useOnlyCoreFonts = true;
                $mPDF1->SetTitle("anteproyectos - Reporte");
                $mPDF1->SetAuthor("Autonoma");
                $mPDF1->SetWatermarkText("Autonoma");
                $mPDF1->showWatermarkText = true;
                $mPDF1->watermark_font = 'DejaVuSansCondensed';
                $mPDF1->watermarkTextAlpha = 0.1;
                $mPDF1->SetDisplayMode('fullpage');
                $mPDF1->WriteHTML($this->renderPartial('reportpdf', ['model'=>$model], true)); //hacemos un render partial a una vista preparada, en este caso es la vista pdfReport
                $mPDF1->Output('Anteproyectos'.date('YmdHis'),'I');  //Nombre del pdf y parámetro para ver pdf o descargarlo directamente.
                exit;
            }
            else
            {
                $form->getErrors();
            }
        }
        return $this->render("reportante", [
          "model" => $model,
          "form" => $form,
          "search" => $search,

          ]);
    }

  
    /**
     * Displays a single Anteproyecto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /** action download
    * aqui se hace la funcion para descargar
    * los archivos desde la plataforma
    */

    public function actionDownload($id)
{

   $download = Yii::$app->db->createCommand('SELECT  anteproyecto.archivo_anteproyecto FROM anteproyecto WHERE idanteproyecto=:id')
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

public function actionDownload1($id)
{

$download = Yii::$app->db->createCommand('SELECT  anteproyecto.archivo_anteproyecto FROM anteproyecto WHERE idanteproyecto=:id AND estado = 1')
   ->bindValue(':id', $_GET['id'])
   ->queryAll();
  //  var_dump($download);
  //  exit();
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


 // acion para colocar los anteproyecto visibles al jurado o comite o lo que sea

 public function actionPublic($id)
    {
        // $model = $this->findModel($id);
        $model = new Anteproyecto();
         $params = [':id' => $_GET['id']];
          $actualizar = Yii::$app->db->createCommand('UPDATE  anteproyecto SET estado = 1 WHERE idanteproyecto=:id')
            ->bindValues($params);
            $actualizar->execute();
            \Yii::$app->session->setFlash('success', 'anteproyecto publicado');
             return $this->redirect(['index', 'id' => $model->idanteproyecto]);

    }




    /**
     * Creates a new Anteproyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Anteproyecto();

        if ($model->load(Yii::$app->request->post())) {
          // se guarda el id del usuario

            $model->date_create = date('Y-m-d H:m:s');
             $model->id = Yii::$app->user->id;

           // se obtiene la instacia del archivo subido

             $archivo = $model->nombre;
             $model->file = UploadedFile::getInstance($model, 'file');
             $model->file->saveAs('anteproyecto/'.$archivo.'.'.$model->file->extension );

             // guardando el camino en la Bd columna

             $model->archivo_anteproyecto = 'anteproyecto/'.$archivo.'.'.$model->file->extension;

             $model->save(false);
            return $this->redirect(['view', 'id' => $model->idanteproyecto]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Anteproyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
          $model->estado = 0;
          $archivo = $model->nombre;
          $model->file = UploadedFile::getInstance($model, 'file');
          $model->file->saveAs('anteproyecto/'.$archivo.'.'.$model->file->extension );

          // guardando el camino en la Bd columna

          $model->archivo_anteproyecto = 'anteproyecto/'.$archivo.'.'.$model->file->extension;

          $model->save(false);
            return $this->redirect(['view', 'id' => $model->idanteproyecto]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Anteproyecto model.
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
     * Finds the Anteproyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Anteproyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Anteproyecto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
