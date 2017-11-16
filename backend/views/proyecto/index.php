<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
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



              [
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
