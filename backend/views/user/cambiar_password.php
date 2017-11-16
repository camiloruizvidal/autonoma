<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\Widget\Alert;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($user, 'currentPassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'newPassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'newPasswordConfirm')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
