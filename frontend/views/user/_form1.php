<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'codigo_estudiantil')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'facultad')->dropDownList([ 'Ing. Sistemas informatico' => 'Ing. Sistemas informatico', 'Ing. Ambiental' => 'Ing. Ambiental', 'Ing. Electronica' => 'Ing. Electronica', '' => '', ],['readonly' => true, 'disabled'=>'true'], ['prompt' => '']) ?>

    <?= $form->field($model, 'username')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Inactivo' => 'Inactivo', 'Activo' => 'Activo' ]) ?>

    <div class="form-group">
        <?= Html::submitButton( 'Actualizar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
