<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Jurado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurado-form">
    <?php
    $form       = ActiveForm::begin();
    $connection = Yii::$app->getDb();
    $command    = $connection->createCommand("SELECT 
  `user`.`id`,
  UPPER(CONCAT_WS(' ',
  `user`.`nombre`,
  `user`.`apellido`)) as jurado
FROM
  `auth_assignment`
  INNER JOIN `user` ON (`auth_assignment`.`user_id` = `user`.`id`)
  WHERE
  `auth_assignment`.`item_name`='Jurado'
  ORDER BY 2");
    $result     = $command->queryAll();
    ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    <?php echo $form->field($model, 'id_usuario_jurado')->dropDownList(ArrayHelper::map($result, 'id', 'jurado'), ['prompt' => 'seleccione el usuario']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
