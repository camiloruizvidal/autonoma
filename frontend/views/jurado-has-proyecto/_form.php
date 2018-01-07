<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Jurado;
use backend\models\Proyecto;
/* @var $this yii\web\View */
/* @var $model backend\models\JuradoHasProyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurado-has-proyecto-form">
    <div class="container-fluid">
        <?php
        $form = ActiveForm::begin();
        $connection = Yii::$app->getDb();
        $command    = $connection->createCommand("SELECT 
  `proyecto`.`idproyecto`,
  `proyecto`.`nombre`
FROM
  `proyecto`
WHERE
  `proyecto`.`idproyecto` NOT IN (SELECT `jurado_has_proyecto`.`idproyecto` FROM `jurado_has_proyecto`)
  ORDER BY
  `proyecto`.`nombre`");
        $result = $command->queryAll();
        ?>

        <div class="col-md-6">
            <?=
            $form->field($model, 'idjurado')->dropDownList(
                    ArrayHelper::map(Jurado::find()->orderBy(['nombre' => SORT_ASC])->all(), 'idjurado', 'nombre'), ['prompt' => 'seleccione un Jurado']
            )
            ?>
        </div>
        <div class="col-md-6">
            <?=
            $form->field($model, 'idjurado2')->dropDownList(
                    ArrayHelper::map(Jurado::find()->orderBy(['nombre' => SORT_ASC])->all(), 'idjurado', 'nombre'), ['prompt' => 'seleccione el segundo Jurado']
            )
            ?>
        </div>
        <div class="col-md-12">
            <?=
            $form->field($model, 'idproyecto')->dropDownList(ArrayHelper::map($result, 'idproyecto', 'nombre'), ['prompt' => 'seleccione el proyecto'])
            ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
