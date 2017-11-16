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


    <?= $form->field($model, 'nombre')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'idmodalidad')->dropDownList(
        ArrayHelper::map(Modalidad::find()->all(), 'idmodalidad', 'nombre'), ['readonly' => true],
        ['prompt' => 'seleccione una modalidad']
      ) ?>



    <div class="form-group">
        <?= Html::submitButton('Actualizar', ['class' =>  'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
