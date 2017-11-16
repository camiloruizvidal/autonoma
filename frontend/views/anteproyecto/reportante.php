<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use backend\models\Modalidad;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anteproyecto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $f = ActiveForm::begin([
        "method" => "get",
        "action" => Url::toRoute("anteproyecto/reportante"),
        "enableClientValidation" => true,
    ]);
    ?>


    <div class="form-group">

      <?= $f->field($form, 'q')->dropDownList(
          ArrayHelper::map(Modalidad::find()->all(), 'idmodalidad', 'nombre'),
          ['prompt' => 'seleccione la Modalidad']
        ) ?>

      <?= $f->field($form, 'fechaini')->widget(
      DatePicker::className(), [
          // inline too, not bad
           'inline' => false,
           // modify template for custom rendering
          //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
          'clientOptions' => [
              'autoclose' => true,
              'format' => 'yyyy-mm-dd'
          ]
  ]);?>

  <?= $f->field($form, 'fechafin')->widget(
  DatePicker::className(), [
      // inline too, not bad
       'inline' => false,
       // modify template for custom rendering
      //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
      'clientOptions' => [
          'autoclose' => true,
          'format' => 'yyyy-mm-dd'
      ]
]);?>
    </div>

    <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>

    <?php $f->end() ?>
