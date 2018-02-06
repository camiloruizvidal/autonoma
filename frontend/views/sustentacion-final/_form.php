<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Proyecto;
use dosamigos\datetimepicker\DateTimePicker;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
<?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <div class="container-fluid">
                <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-6">
                <?=
                $form->field($model, 'fecha')->widget(DateTimePicker::className(), [
                    'language'       => 'es',
                    'size'           => 'ms',
                    //'template' => '{input}',
                    'pickButtonIcon' => 'glyphicon glyphicon-time',
                    'inline'         => false,
                    'clientOptions'  => [
                        'startView'  => 1,
                        'minView'    => 0,
                        'maxView'    => 1,
                        'autoclose'  => true,
                        'linkFormat' => 'yyyy-mm-dd-HH:ii P', // if inline = true
                        // 'format' => 'HH:ii P', // if inline = false
                        'todayBtn'   => true
                    ]
                ]);
                ?>
            </div>
            <div class="col-md-6">
                <!-- <?=
                $form->field($model, 'fecha')->widget(
                        DateTimePicker::className(), [
                    // inline too, not bad
                    'inline'        => false,
                    'size'          => 'ms',
                    // modify template for custom rendering
                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format'    => 'yyyy-mm-dd - HH:ii ',
                        'todayBtn'  => true
                    ]
                ]);
                ?> -->
            </div>
            <div class="col-md-6">
                <?=
                $form->field($model, 'idproyecto')->dropDownList(
                        ArrayHelper::map(Proyecto::find()->all(), 'idproyecto', 'nombre'), ['prompt' => 'seleccione el proyecto']
                )
                ?>
            </div>

            <div class="col-md-6">
<?= $form->field($model, 'lugar')->textInput() ?>
            </div>
            <div class="col-md-6">
                <label>Estado de la sustentación</label>
                <select id="estados" class="form-control" name="SustentacionFinal[estados]" aria-required="true" aria-invalid="false">
                    <option value="Aprobado para sustentar">Aprobado para sustentar</option>
                    <option value="Aprobada sustentacion">Aprobada sustentacion</option>
                    <option value="No aprobada sustentacion">No aprobada sustentacion</option>
                </select>
            </div>

        </div>
    </div>

    <div class="panel-footer">
<?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
</div>
