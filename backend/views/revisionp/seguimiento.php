<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RevisionpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Revisiones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="revisonp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php

     // se realiza una funcion para hacer un formulario mas bonito
      Modal::begin([
          'header' => '<h4>Anteproyecto</h4>',
          'id' => 'modal',
          'size' => 'modal-lg',
      ]);
      echo "<div id='modalContent'></div>";

      Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idrevisonp',
            //'proyecto',
            'descripcion',
            'correccion',
            //'archivo',
            'estado',
            // 'idproyecto',

            [
             'class' => 'yii\grid\ActionColumn',
             'template' => '{download}',
             'buttons' => [
                        'download' => function ($url, $model) {
                     return Html::a(
                           Html::img('image/descarga.png',['width' => '15']),
                         ['revisionp/download', 'id' => $model->idrevisonp],
                         [
                             'title' => 'Descargar',
                             'data-pjax' => '0',
                         ]
                     );
                 },
             ],
         ],
        ],
    ]); ?>
</div>
