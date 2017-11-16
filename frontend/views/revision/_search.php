<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RevisionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="revision-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idrevision') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'correccion') ?>

    <?= $form->field($model, 'archivo') ?>

    <?= $form->field($model, 'estado') ?>

    <?= $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'idanteproyecto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
