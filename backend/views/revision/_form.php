<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Anteproyecto;
/* @var $this yii\web\View */
/* @var $model backend\models\Revision */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="revision-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'correccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file1')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'Correcion' => 'Correcion', 'Rechazado' => 'Rechazado', 'Aprobado' => 'Aprobado', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'idanteproyecto')->dropDownList(
      ArrayHelper::map(Anteproyecto::find()->all(), 'idanteproyecto', 'nombre'),
      ['prompt' => 'selesccione el anteproyecto']
      ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
