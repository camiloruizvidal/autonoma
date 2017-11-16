<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Proyecto;
use dosamigos\datetimepicker\DateTimePicker;
//use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\SustentacionFinal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sustentacion-final-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'fecha')->widget(DateTimePicker::className(), [
        'language' => 'es',
        'size' => 'ms',
        //'template' => '{input}',
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'inline' => false,
        'clientOptions' => [
            'startView' => 1,
            'minView' => 0,
            'maxView' => 1,
            'autoclose' => true,
            'linkFormat' => 'yyyy-mm-dd-HH:ii P', // if inline = true
            // 'format' => 'HH:ii P', // if inline = false
            'todayBtn' => true
        ]
    ]);?>
    <!-- <?= $form->field($model, 'fecha')->widget(
    DateTimePicker::className(), [
        // inline too, not bad
         'inline' => false,
         'size' => 'ms',
         // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd - HH:ii ',
            'todayBtn' => true
        ]
]);?> -->

    <?= $form->field($model, 'idproyecto')->dropDownList(
        ArrayHelper::map(Proyecto::find()->all(), 'idproyecto', 'nombre'),
        ['prompt' => 'seleccione el proyecto']
      ) ?>

      <?= $form->field($model, 'lugar')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
