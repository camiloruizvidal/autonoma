<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use backend\models\DirectorProyecto;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <?php
    $f                             = ActiveForm::begin([
                "method"                 => "get",
                "action"                 => Url::toRoute("user/reportestu"),
                "enableClientValidation" => true,
    ]);
    ?>
    <div class="panel-body">
        <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
        <label> 
            Por favor digite el número de identificación del estudiante 
        </label>
        <div class="form-group">
            <?= $f->field($form, 'q')->textInput() ?>
        </div>
    </div>
    <div class="panel-footer">
        <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
    </div>
    <?php $f->end() ?>
</div>
