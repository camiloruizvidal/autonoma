<style> 
    .yii-debug-toolbar__bar,nav, .btn-success,.breadcrumb{
        display:none;
    }
    .container{
        padding-right: 0px !important;
        padding-top: 0px !important;
        padding-left: 0px !important;
        padding-bottom: 0px !important;
    }
    .wrap{
        background-color: #FFF;
    }
</style> 
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;

$this->title                   = 'Registro';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    function validar(value)
    {
        switch (value)
        {
            case 'Estudiante':
                if ($('#Estudiante').prop('checked'))
                {
                    $("#Comite,#Secretario,#Docente,#Jurado").attr("disabled", true);
                    $("#Comite,#Secretario,#Docente,#Jurado").hide();
                }
                else
                {
                    $("#Comite,#Secretario,#Docente,#Jurado").removeAttr("disabled");
                    $("#Comite,#Secretario,#Docente,#Jurado").show();
                }
                break;
            case 'Docente':
                if ($('#Docente').prop('checked'))
                {
                    $("#Estudiante,#Secretario").attr("disabled", true);
                    $("#Estudiante,#Secretario").hide();
                }
                else
                {
                    $("#Estudiante,#Secretario").removeAttr("disabled");
                    $("#Estudiante,#Secretario").show();
                }
                break;
            case 'Jurado':
                if ($('#Jurado').prop('checked'))
                {
                    $("#Estudiante,#Secretario").attr("disabled", true);
                    $("#Estudiante,#Secretario").hide();
                }
                else
                {
                    $("#Estudiante,#Secretario").removeAttr("disabled");
                    $("#Estudiante,#Secretario").show();
                }
                break;
            case 'Secretario':
                if ($('#Secretario').prop('checked'))
                {
                    $("#Comite,#Estudiante,#Docente,#Jurado").attr("disabled", true);
                    $("#Comite,#Estudiante,#Docente,#Jurado").hide();
                }
                else
                {
                    $("#Comite,#Estudiante,#Docente,#Jurado").removeAttr("disabled");
                    $("#Comite,#Estudiante,#Docente,#Jurado").show();
                }
                break;
            case 'Comite':
                if ($('#Comite').prop('checked'))
                {
                    $("#Estudiante,#Secretario").attr("disabled", true);
                    $("#Estudiante,#Secretario").hide();
                }
                else {

                    $("#Estudiante,#Secretario").removeAttr("disabled");
                    $("#Estudiante,#Secretario").show();
                }

                break;
        }
    }
    $(function ()
    {
        $.each($('.field-signupform-permissions .checkbox input'), function (index, value)
        {
            console.log($(value).html());
            var id = $.trim($(value).parent().text());
            $(value).attr('id', id);
            $(value).addClass('roles');
            console.log($(value).html());
        });
        $('.roles').click(function ()
        {
            var value = $(this).val();
            validar(value)
        });
    });
</script>
<?php $form                          = ActiveForm::begin(['id' => 'form-signup']); ?>
<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'nombre')->textInput(['autofocus' => true]) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'apellido')->textInput() ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'codigo_estudiantil')->textInput() ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'facultad')->dropDownList(['Ing. Sistemas informatico' => 'Ing. Sistemas informatico', 'Ing. Ambiental' => 'Ing. Ambiental', 'Ing. Electronica' => 'Ing. Electronica'], ['prompt' => 'selecciones una facultad']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'username')->textInput() ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'email') ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'password')->passwordInput() ?>
    </div>
    <div class="col-md-12">
        <!-- se utiliza el arrayhelper para buscar los roles que existen en la tabla authitem -->
        <?php $authItems                     = ArrayHelper::map($authItems, 'name', 'name') ?>
        <?= $form->field($model, 'permissions')->checkBoxList($authItems); ?>
    </div>
</div>
<?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
<?php ActiveForm::end(); ?>