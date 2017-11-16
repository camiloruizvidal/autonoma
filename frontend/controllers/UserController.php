<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use frontend\models\FormSearch;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;
use yii\helpers\Html;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReportestu()
    {
        $table = new User;
        $model = $table->find()->all();

        $form = new FormSearch;
        $search = null;
        if($form->load(Yii::$app->request->get()))
        {
            if ($form->validate())
            {
                $search = Html::encode($form->q);

                //$search2 = Html::encode($form->q);
                // var_dump($search1);
                // exit();
                $query = "SELECT user.nombre AS Estudiante, proyecto.nombre AS Proyecto, user.apellido AS Apellido, revisonp.Estado AS Estado
                FROM user
                INNER JOIN proyecto on proyecto.id = user.id
                INNER JOIN revisonp on revisonp.idproyecto = proyecto.idproyecto
                WHERE   user.codigo_estudiantil LIKE '$search'
                Order by proyecto.date_create ASC";

                $query1 = "SELECT  user.nombre AS Estudiante,user.apellido AS Apellido, anteproyecto.nombre AS Anteproyecto, revision.Estado AS Estado
                FROM user
                INNER jOIN anteproyecto ON anteproyecto.id = user.id
                INNER JOIN revision on revision.idanteproyecto = anteproyecto.idanteproyecto
                WHERE   user.codigo_estudiantil LIKE '$search'
                ORDER BY anteproyecto.date_create ASC";
                //$query .= "Nombre LIKE '%$search%' OR Apellido LIKE '%$search%'";
                $model = $table->findBySql($query)->all();
                $model1 = $table->findBySql($query1)->all();
                $mPDF1 = new \Mpdf\Mpdf(); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
                $mPDF1->useOnlyCoreFonts = true;
                $mPDF1->SetTitle("proyectos - Reporte");
                $mPDF1->SetAuthor("Autonoma");
                $mPDF1->SetWatermarkText("Autonoma");
                $mPDF1->showWatermarkText = true;
                $mPDF1->watermark_font = 'DejaVuSansCondensed';
                $mPDF1->watermarkTextAlpha = 0.1;
                $mPDF1->SetDisplayMode('fullpage');
                $mPDF1->WriteHTML($this->renderPartial('estupdf', ['model'=>$model, 'model1'=>$model1], true)); //hacemos un render partial a una vista preparada, en este caso es la vista pdfReport
                $mPDF1->Output('proyectos'.date('YmdHis'),'I');  //Nombre del pdf y parámetro para ver pdf o descargarlo directamente.
                exit;
            }
            else
            {
                $form->getErrors();
            }
        }
        return $this->render("reportestu", [
          "model" => $model,
          "form" => $form,
          "search" => $search,

          ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
