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

    <div class="container-fluid">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-3">
            <?= $form->field($model, 'nombre')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'descripcion')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($model, 'idmodalidad')->dropDownList(
                    ArrayHelper::map(Modalidad::find()->all(), 'idmodalidad', 'nombre'), ['prompt' => 'seleccione una modalidad']
            )
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'file')->fileInput() ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'objetivos')->textArea() ?>
        </div>    
        <div class="col-md-12">
            <?= $form->field($model, 'planteamiento_problema')->textArea() ?>
        </div>    
        <div class="col-md-12">
            <?= $form->field($model, 'justificacion')->textArea() ?>
        </div>    

    </div>
</div>

</div>
</div>
<div class="panel-footer">
    <div class="form-group">
        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
