<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Evento;
use frontend\models\EventoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * EventoController implements the CRUD actions for Evento model.
 */
class EventoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
          'access' => [
               'class' => AccessControl::className(),
               'only' => ['create', 'cronograma'],
               'rules' => [
                   [
                       'allow' => true,
                       'actions' => ['create'],
                       'roles' => [ 'Secretario'],
                   ],
                   [
                       'allow' => true,
                       'actions' => ['cronograma'],
                       'roles' => ['Estudiante', 'Docente', 'Comite'],
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
     * Lists all Evento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $events = Evento::find()->All();
        $stasks = [];

        foreach ($events as $eve) {
          $event = new \yii2fullcalendar\models\Event();
          $event->id = $eve->idevento;
          $event->backgroundColor = '#0061a2';

          $event->title = $eve->titulo;
          $event->start = $eve->fecha;
          $stasks[] = $event;
        }

        return $this->render('index', [
            'events' => $stasks,
        ]);
    }
    public function actionCronograma()
    {
        $events = Evento::find()->All();
        $stasks = [];

        foreach ($events as $eve) {
          $event = new \yii2fullcalendar\models\Event();
          $event->id = $eve->idevento;
          $event->backgroundColor = '#0061a2';

          $event->title = $eve->titulo;
          $event->start = $eve->fecha;
          $stasks[] = $event;
        }

        return $this->render('cronograma', [
            'events' => $stasks,
        ]);
    }

    /**
     * Displays a single Evento model.
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
     * Creates a new Evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($date)
    {
        $model = new Evento();
        $model->fecha = $date;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Evento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idevento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Evento model.
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
     * Finds the Evento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Evento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
