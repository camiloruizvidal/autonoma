<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Proyecto;
use dosamigos\datepicker\DatePicker;


/* @var $this yii\web\View */
/* @var $model backend\models\SustentacionFinal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sustentacion-final-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'fecha')->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => false,
         // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
]);?>

    <?= $form->field($model, 'idproyecto')->dropDownList(
        ArrayHelper::map(Proyecto::find()->all(), 'idproyecto', 'nombre'),
        ['prompt' => 'seleccione el proyecto']
      ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
