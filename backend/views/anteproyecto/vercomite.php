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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idanteproyecto',
            'nombre',
            'descripcion',
            'archivo_anteproyecto',
            //'Modalidad',
            [
              'class' => 'yii\grid\ActionColumn',
             'template' => '{download1},  {view}',
             'buttons' => [
                        'download1' => function ($url, $model) {
                     return Html::a(
                        Html::img('image/descarga.png',['width' => '15']),
                         ['anteproyecto/download1', 'id' => $model->idanteproyecto],
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
    <?php Pjax::end(); ?>
</div>
