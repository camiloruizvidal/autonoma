<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title                   = 'Inicio de Sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="./css/login.css?v=<?php echo date('Ymdihs');?>" rel="stylesheet"/>
<div class = "container">
    <div class="wrapper">
        <form id="login_form" method="post" name="Login_Form" class="form-signin">       
            <?php $form                          = ActiveForm::begin(['id' => 'login-form']); ?>
            <h3 class="form-signin-heading">Bienvenido, por favor inicie sesión</h3>
            <center><img src="imagen/autonoma.png" class="img-responsive" width="60%"></center>
            <hr class="colorgraph"><br>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <div style="color:#999;margin:1em 0">
                Olvidaste tu Contraseña ? <?= Html::a('Click Aquí', ['site/request-password-reset']) ?>.
            </div>
            <div class="form-group">
                <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>


            <?php ActiveForm::end(); ?>
        </form>			
    </div>
</div>

