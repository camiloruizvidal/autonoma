<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\DirectorProyecto;
use backend\models\Anteproyecto;
/* @var $this yii\web\View */
/* @var $model backend\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'descripcion')->textArea(['readonly' => true]) ?>

    <?= $form->field($model, 'file')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file1')->fileInput(['readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton( 'Actualizar', ['class' =>  'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
