<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Anteproyecto;

/* @var $this yii\web\View */
/* @var $model backend\models\Revision */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="js/tinymce.jquery.min.js" type="text/javascript"></script>
<link href="css/tinyeditor.css" rel="stylesheet" type="text/css"/>
<script>
    $(function ()
    {
        $('#revision-file').attr('required', 'required');
        tinymce.init({
            selector: "textarea",
            theme: "modern",
            height: 500});
    });
</script>
<div class="revision-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'file')->fileInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <?= $form->field($model, 'estado')->dropDownList([ 'Corrección' => 'Corrección', 'Rechazado' => 'Rechazado', 'Aceptado' => 'Aceptado',], ['prompt' => '']) ?>
                </div>
                <div class="col-md-6">
                    <?=
                    $form->field($model, 'idanteproyecto')->dropDownList(
                            ArrayHelper::map(Anteproyecto::find()->all(), 'idanteproyecto', 'nombre'), ['prompt' => 'Seleccione el Anteproyecto']
                    )
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'correccion')->textarea(['maxlength' => true]) ?>
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary']) ?>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>
