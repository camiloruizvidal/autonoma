<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\AuthItem;
use frontend\models\ChangePassword;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['Secretario'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
      //  $fecha_inicial = Yii::$app->user->identity->created_at;
      if (!Yii::$app->user->isGuest) {

        $fecha_inicial = Yii::$app->user->identity->created_at;
        $hoy = date('Y-m-j');
        // var_dump($hoy);
        // exit();
        $nuevafecha = strtotime ( '+1 year' , strtotime ( $fecha_inicial ) ) ;
        $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
        $start_ts = strtotime($hoy);
      $end_ts = strtotime($nuevafecha);
      $diferencia = $end_ts - $start_ts;
      $dif_dias = round($diferencia / 86400);

      if ($dif_dias == 0) {
        $connection= Yii::$app->db->createCommand()
        ->update('user', ['status' => 'Inactivo'], 'id='.Yii::$app->user->id)
			->execute();
        return $this->render('index',[
          'restante' => $dif_dias
        ]);
      }
      $cont = Yii::$app->user->identity->cont;
      if ($cont ==0) {
        //Html::script('alert("Cambie su contraseña aqui");', ['defer' => true]);
        Yii::$app->session->setFlash('warning', 'Por favor cambie contraseña.');
        $connection= Yii::$app->db->createCommand()
        ->update('user', ['cont' => 1], 'id='.Yii::$app->user->id)
      ->execute();
      return $this->render('index',[
        'restante' => $dif_dias
      ]);
      }

      return $this->render('index',[
        'restante' => $dif_dias
      ]);
}
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        // se establece una variable donde se obtendran los authitem
        $authItems = AuthItem::find()->all();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {

                    \Yii::$app->session->setFlash('success', ' usuario Creado exitosamente');
                    return $this->redirect('index.php?r=site%2Fsignup');
                 //$this->goHome();
                    //return $this->redirect(\Yii::$app->urlManagerBackEnd->baseUrl);// asi se dirreciona al backend
                  //  return $this->redirect($this->goHome());// asi se dirreciona al backend

            }
        }

        return $this->render('signup', [
            'model' => $model,
            'authItems' => $authItems,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Mira tu Correo.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Los siento. No se pudo enviar este correo.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
      // cambiar password
      public function actionChangePassword()
        {
            $model = new ChangePassword();
            if ($model->load(Yii::$app->getRequest()->post()) && $model->change()) {
                return $this->goHome();
            }
            return $this->render('change-password', [
                    'model' => $model,
            ]);
        }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Nueva contraseña guardada.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
