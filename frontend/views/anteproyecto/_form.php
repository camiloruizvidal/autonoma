<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Modalidad;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Anteproyecto */
/* @var $form yii\widgets\ActiveForm */
?><div class="panel panel-primary">
<?php $form = ActiveForm::begin(); ?>
    <div class="panel-heading">
        Los campos con <span class="required">*</span> son requeridos.
    </div>
    <div class="panel-body">
        <div class="container-fluid">
            <div class="col-md-3">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
            </div>    
            <div class="col-md-3">
                <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
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
    <div class="panel-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>