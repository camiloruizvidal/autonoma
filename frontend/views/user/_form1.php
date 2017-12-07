<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .breadcrumb{display:none;}
</style>
<?php $form = ActiveForm::begin(); ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Editar
    </div>
    <div class="panel-body">
        <div class="user-form">
            <div class="col-md-6">
                <?= $form->field($model, 'nombre')->textInput() ?>
            </div>
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'apellido')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'codigo_estudiantil')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'facultad')->dropDownList([ 'Ing. Sistemas informatico' => 'Ing. Sistemas informatico', 'Ing. Ambiental' => 'Ing. Ambiental', 'Ing. Electronica' => 'Ing. Electronica', '' => '',], ['prompt' => '']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'username')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'email')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'status')->dropDownList([ 'Inactivo' => 'Inactivo', 'Activo' => 'Activo']) ?>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>