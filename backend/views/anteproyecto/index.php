<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AnteproyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anteproyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anteproyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?php  Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' =>function($model){
            if ($model->estado == 0) {
              return ['class' => 'danger'];
            }elseif ($model->estado == 1) {
              return ['class' => 'success'];
            }

        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            //'idanteproyecto',
            [ // asi se establece un campo de otra tabla con el searching GridView
              'attribute' => 'id',
              'value' =>     'id0.username',
            ],
            'nombre',
            'descripcion',
            //'archivo_anteproyecto',
            'date_create',
            //'id0.nombre',
            [ // asi se establece un campo de otra tabla con el searching GridView
              'attribute' => 'idmodalidad',
              'value' =>     'idmodalidad0.nombre',
            ],
            [
             'class' => 'yii\grid\ActionColumn',
             'template' => '{download}, {public}, {view}',
             'buttons' => [
                        'download' => function ($url, $model) {
                     return Html::a(
                          Html::img('image/descarga.png',['width' => '15']),
                         ['anteproyecto/download', 'id' => $model->idanteproyecto],
                         [
                             'title' => 'Descargar',
                             'data-pjax' => '0',
                         ]
                     );
                 },
                     'public' => function ($url, $model) {
                  return Html::a(
                      Html::img('image/publicar.png',['width' => '15']),
                      ['anteproyecto/public', 'id' => $model->idanteproyecto],
                      [
                          'title' => 'Publicar',
                          'data-pjax' => '0',
                      ]
                  );
              },
             ],
         ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
