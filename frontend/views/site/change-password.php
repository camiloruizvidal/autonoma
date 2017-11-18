<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ChangePassword */

$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php $form                          = ActiveForm::begin(['id' => 'form-change']); ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Por favor digite los siguientes campos para cambiar la contraseña
    </div>
    <div class="panel-body">
        <?= $form->field($model, 'oldPassword')->passwordInput() ?>
        <?= $form->field($model, 'newPassword')->passwordInput() ?>
        <?= $form->field($model, 'retypePassword')->passwordInput() ?>
        <div class="form-group">
        </div>
    </div>
    <div class="panel-footer">
        <?= Html::submitButton('Cambiar', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>