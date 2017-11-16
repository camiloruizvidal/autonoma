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

$this->title = 'Estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $f = ActiveForm::begin([
        "method" => "get",
        "action" => Url::toRoute("user/reportestu"),
        "enableClientValidation" => true,
    ]);
    ?>

    <h5><b><p> 
    Por favor digite el número de identificación del estudiante 
	</p></b></h5>
    <div class="form-group">

      <?= $f->field($form, 'q')->textInput()?>

    </div>

    <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>

    <?php $f->end() ?>
