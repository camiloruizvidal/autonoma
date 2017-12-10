﻿<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Anteproyecto;
/* @var $this yii\web\View */
/* @var $model backend\models\Revision */
/* @var $form yii\widgets\ActiveForm */
?>
<link href="css/bootstrap-select2.min.css" rel="stylesheet" type="text/css"/>
<script src="js/bootstrap-select2.min.js"></script>
<script>
    $(function ()
    {
        $('#revision-idanteproyecto').select2();
    });
</script>   
<div class="revision-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'correccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'Corrección' => 'Corrección', 'Rechazado' => 'Rechazado', 'Aceptado' => 'Aceptado', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'idanteproyecto')->dropDownList(
      ArrayHelper::map(Anteproyecto::find()->all(), 'idanteproyecto', 'nombre'),
      ['prompt' => 'Seleccione el Anteproyecto']
      ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
