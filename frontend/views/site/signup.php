<style> 
    nav, .btn-success,.breadcrumb{
        display:none;
    }
    .container{
        padding-right: 0px !important;
        padding-top: 0px !important;
        padding-left: 0px !important;
        padding-bottom: 0px !important;
    }
</style> 
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;

$this->title                   = 'Registro';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form                          = ActiveForm::begin(['id' => 'form-signup']); ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'nombre')->textInput(['autofocus' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'apellido')->textInput() ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'codigo_estudiantil')->textInput() ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'facultad')->dropDownList(['Ing. Sistemas informatico' => 'Ing. Sistemas informatico', 'Ing. Ambiental' => 'Ing. Ambiental', 'Ing. Electronica' => 'Ing. Electronica'], ['prompt' => 'selecciones una facultad']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'username')->textInput() ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'email') ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'password')->passwordInput() ?>
    </div>
    <div class="col-md-6">
        <!-- se utiliza el arrayhelper para buscar los roles que existen en la tabla authitem -->
        <?php $authItems                     = ArrayHelper::map($authItems, 'name', 'name') ?>
        <?= $form->field($model, 'permissions')->checkBoxList($authItems); ?>
    </div>
</div>
<?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
<?php ActiveForm::end(); ?>