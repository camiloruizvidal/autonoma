<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\RevisionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seguimiento';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="revision-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],
           'idanteproyecto0.nombre',
            'descripcion',
            'correccion',
            'archivo',
            'estado',
            //'date_create',
            // 'idanteproyecto',

          //  ['class' => 'yii\grid\ActionColumn'],
          [
           'class' => 'yii\grid\ActionColumn',
           'template' => '{download}',
           'buttons' => [
                      'download' => function ($url, $model) {
                   return Html::a(
                         Html::img('image/descarga.png',['width' => '15']),
                       ['revision/download', 'id' => $model->idrevision],
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
