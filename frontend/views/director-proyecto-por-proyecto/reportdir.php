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

$this->title                   = 'Director por Proyecto';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php // echo $this->render('_search', ['model' => $searchModel]);   ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?php
        $f                             = ActiveForm::begin([
                    "method"                 => "get",
                    "action"                 => Url::toRoute("director-proyecto-por-proyecto/reportdir"),
                    "enableClientValidation" => true,
        ]);
        ?>

        <?=
        $f->field($form, 'q')->dropDownList(
                ArrayHelper::map(DirectorProyecto::find()->all(), 'iddirector_proyecto', 'nombre'), ['prompt' => 'seleccione el director']
        )
        ?>

        <?=
        $f->field($form, 'fechaini')->widget(
                DatePicker::className(), [
            // inline too, not bad
            'inline'        => false,
            // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd'
            ]
        ]);
        ?>

        <?=
        $f->field($form, 'fechafin')->widget(
                DatePicker::className(), [
            // inline too, not bad
            'inline'        => false,
            // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd'
            ]
        ]);
        ?>
    </div>
    <div class="panel-footer">
        <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
    </div>
</div>
<?php $f->end() ?>
