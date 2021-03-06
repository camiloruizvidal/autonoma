<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SustentacionFinalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sustentacion Final';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sustentacion-final-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php

     // se realiza una funcion para hacer un formulario mas bonito
      Modal::begin([
          'header' => '<h4>Sustentacion Final</h4>',
          'id' => 'modal',
          'size' => 'modal-lg',
      ]);
      echo "<div id='modalContent'></div>";

      Modal::end();
    ?>
    <p>
        <?= Html::button('Crear Sustentacion Final', ['value'=>Url::to('index.php?r=sustentacion-final/create'),'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>

    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idsustentacion_final',
            'fecha',
            //'idproyecto0.nombre',
            [ // asi se establece un campo de otra tabla con el searching GridView
              'attribute' => 'idproyecto',
              'value' =>    'idproyecto0.nombre',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
