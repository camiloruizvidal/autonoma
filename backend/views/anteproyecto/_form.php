<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Modalidad;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Anteproyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anteproyecto-form">

    <?php $form = ActiveForm::begin(); ?>
    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'idmodalidad')->dropDownList(
        ArrayHelper::map(Modalidad::find()->all(), 'idmodalidad', 'nombre'),
        ['prompt' => 'seleccione una modalidad']
      ) ?>

      

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
