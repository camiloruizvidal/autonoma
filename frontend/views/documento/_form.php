<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Documento */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #modalContent .documento-create h1{
        display: none;
    }
</style>
<div class="documento-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">Crear documento</div>
        <div class="panel-body">
            <div class="col-xs-4">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-xs-4">
                <?=
                $form->field($model, 'id_documento_tipo')->dropDownList(\yii\helpers\ArrayHelper::map(frontend\models\DocumentoTipo::find()->all(), 'id_documento_tipo', 'descripcion'));
                ?>
            </div>
            <div class="col-xs-4">
                <?= $form->field($model, 'file')->fileInput() ?>
            </div>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton('Subir', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
