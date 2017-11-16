<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JuradoHasProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jurado por Proyecto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurado-has-proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php

     // se realiza una funcion para hacer un formulario mas bonito
      Modal::begin([
          'header' => '<h4>Jurado por Proyecto</h4>',
          'id' => 'modal',
          'size' => 'modal-lg',
      ]);
      echo "<div id='modalContent'></div>";

      Modal::end();
    ?>
    <p>
        <?= Html::button('Asignar jurado', ['value'=>Url::to('index.php?r=jurado-has-proyecto/create'),'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
    </p>
    <?php  Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
      //  'tableOptions'=>['class'=>'table-striped table-bordered table-condensed'],
        'options'=>['style' => 'white-space:nowrap;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['style' => 'background-color:#ef7d2'],

              ],

          //  'idjurado0.nombre',
            // 'idproyecto0.nombre',
            // 'idjurado20.nombre',
            [ // asi se establece un campo de otra tabla con el searching GridView
              'attribute' => 'idjurado',
              'value' =>     'idjurado0.nombre',
            //'headerOptions' => ['style' => 'background-color:#0061a2', ],

            ],
            [ // asi se establece un campo de otra tabla con el searching GridView
              'attribute' => 'idjurado2',
              'value' =>     'idjurado20.nombre',
              //'headerOptions' => ['style' => 'background-color:#0061a2'],

            ],
            [ // asi se establece un campo de otra tabla con el searching GridView
              'attribute' => 'idproyecto',
              'value' =>     'idproyecto0.nombre',
               //'headerOptions' => ['style' => 'background-color:#0061a2'],
              //'options' => [ 'style' => 'background-color:#0000FF'],
            ],

        
        ],
    ]); ?>
    <?php  Pjax::end(); ?>
</div>
