<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Proyecto;
/* @var $this yii\web\View */
/* @var $model backend\models\Revisonp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="revisonp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textInput() ?>

    <?= $form->field($model, 'correccion')->textArea() ?>

    <?= $form->field($model, 'file1')->fileInput() ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'Corrección' => 'Corrección', 'Rechazado' => 'Rechazado', 'Aceptado' => 'Aceptado', ],['prompt' => '']) ?>

    <?= $form->field($model, 'idproyecto')->dropDownList(
      ArrayHelper::map(Proyecto::find()->all(), 'idproyecto', 'nombre'),['disabled' =>true],
      ['prompt' => 'selesccione el Proyecto']
      ) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
