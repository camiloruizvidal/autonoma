<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NovedadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Novedades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedades-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php

     // se realiza una funcion para hacer un formulario mas bonito
      Modal::begin([
          'header' => '<h4>Novedades</h4>',
          'id' => 'modal',
          'size' => 'modal-lg',
      ]);
      echo "<div id='modalContent'></div>";

      Modal::end();
    ?>
    <?php if (Yii::$app->user->can('Secretario')) { ?>


    <p>
        <?= Html::button('Crear Novedad', ['value'=>Url::to('index.php?r=novedades/create'),'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>

    </p>
 <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idnovedades',
            'descripcion',
            'fecha',
            'idproyecto0.nombre',

            ['visible' => Yii::$app->user->can('Secretario'),
              'class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
