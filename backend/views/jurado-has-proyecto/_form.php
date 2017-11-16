<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Jurado;
use backend\models\Proyecto;

/* @var $this yii\web\View */
/* @var $model backend\models\JuradoHasProyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurado-has-proyecto-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'idjurado')->dropDownList(
        ArrayHelper::map(Jurado::find()->all(), 'idjurado', 'nombre'),
        ['prompt' => 'seleccione un Jurado']
      ) ?>

      <?= $form->field($model, 'idjurado2')->dropDownList(
          ArrayHelper::map(Jurado::find()->all(), 'idjurado', 'nombre'),
          ['prompt' => 'seleccione el segundo Jurado']
        ) ?>

    <?= $form->field($model, 'idproyecto')->dropDownList(
        ArrayHelper::map(Proyecto::find()->all(), 'idproyecto', 'nombre'),
        ['prompt' => 'seleccione el proyecto']
      ) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
