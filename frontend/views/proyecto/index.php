<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php  Modal::begin([
        'header' => '<h4>Proyecto</h4>',
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";

    Modal::end();
    ?>
    <?php if (Yii::$app->user->can('Estudiante')) { ?>
    <p>
      <?= Html::button('Crear Proyecto', ['value'=>Url::to('index.php?r=proyecto/create'),'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>

    </p>
    <?php  } ?>


    <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'rowOptions' =>function($model){
              if ($model->estado == 0 && Yii::$app->user->can('Secretario')) {
                return ['class' => 'danger'];
              }elseif ($model->estado == 1 && Yii::$app->user->can('Secretario')) {
                return ['class' => 'success'];
              }

          },
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],

              //'idproyecto',
              [ // asi se establece un campo de otra tabla con el searching GridView
                'attribute' => 'id',
                'value' =>     'id0.username',
              ],
              'nombre',
              'descripcion',
            //  'archivo_proyecto',
              'date_create',
              //'idjurado0.nombre',
              'jurado1',
              'jurado2',



              [
                'visible' => Yii::$app->user->can('Estudiante'),
               'class' => 'yii\grid\ActionColumn',
               'template' => '{update}',
              ],
              [
                'visible' => Yii::$app->user->can('Secretario'),
               'class' => 'yii\grid\ActionColumn',
               'template' => '{update}, {public}',
               'buttons' => [
                 'public' => function ($url, $model) {
              return Html::a(
                  Html::img('image/publicar.png',['width' => '15']),
                  ['proyecto/public', 'id' => $model->idproyecto],
                  [
                      'title' => 'Publicar',
                      'data-pjax' => '0',
                  ]
              );
          },
               ],
              ],

              [
                'visible' => Yii::$app->user->can('Jurado'),
               'class' => 'yii\grid\ActionColumn',
               'template' => '{download}, {view}',
               'buttons' => [
                          'download' => function ($url, $model) {
                       return Html::a(
                             Html::img('image/descarga.png',['width' => '15']),
                           ['proyecto/download', 'id' => $model->idproyecto],
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
