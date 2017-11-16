<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;


$this->title = 'Registro';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>



    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'nombre')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'apellido')->textInput() ?>

                <?= $form->field($model, 'codigo_estudiantil')->textInput() ?>

                <?= $form->field($model, 'facultad')->dropDownList(['Ing. Sistemas informatico' => 'Ing. Sistemas informatico', 'Ing. Ambiental' => 'Ing. Ambiental', 'Ing. Electronica' => 'Ing. Electronica'], ['prompt' => 'selecciones una facultad']) ?>

                <?= $form->field($model, 'username')->textInput() ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                <!-- se utiliza el arrayhelper para buscar los roles que existen en la tabla authitem -->
                <?php $authItems = ArrayHelper::map($authItems, 'name', 'name') ?>
                <?= $form->field($model, 'permissions')->checkBoxList($authItems);  ?>

                <div class="form-group">
                    <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
