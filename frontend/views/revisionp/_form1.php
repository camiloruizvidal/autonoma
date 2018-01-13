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
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'descripcion')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'file1')->fileInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'secretario_aprobado')->dropDownList([ 'si' => 'si', 'no' => 'no']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'estado')->dropDownList([ 'Corrección' => 'Corrección', 'Rechazado' => 'Rechazado', 'Aceptado' => 'Aceptado',], ['prompt' => '']) ?>
        </div>
        <div class="col-md-6">
            <?=
            $form->field($model, 'idproyecto')->dropDownList(
                    ArrayHelper::map(Proyecto::find()->all(), 'idproyecto', 'nombre'), ['disabled' => true], ['prompt' => 'selesccione el Proyecto']
            )
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'correccion')->textArea() ?>
        </div>
    </div>
</div>
</div>

<div class="panel-footer">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
</div>
