<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Proyecto;
use backend\models\DirectorProyecto;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\DirectorProyectoPorProyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="director-proyecto-por-proyecto-form">
    <?php $form = ActiveForm::begin(); ?>
    <?=
    $form->field($model, 'iddirector_proyecto')->dropDownList(
            ArrayHelper::map(DirectorProyecto::find()->all(), 'iddirector_proyecto', 'nombre'), ['prompt' => 'seleccione el director']
    )
    ?>
    <?=
    $form->field($model, 'idproyecto')->dropDownList(
            ArrayHelper::map(Proyecto::find()->all(), 'idproyecto', 'nombre'), ['prompt' => 'seleccione el Proyecto']
    )
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Asignar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
