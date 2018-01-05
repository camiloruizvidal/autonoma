<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JuradoHasProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Jurado por Proyecto';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    $(function ()
    {
        /*        console.log($('th .sorting a'));
         $.each($('th .sorting'), function (index, value)
         {
         console.log(value);
         });*/
    });
</script>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <div class="jurado-has-proyecto-index">
            <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php
            // se realiza una funcion para hacer un formulario mas bonito
            Modal::begin([
                'header' => '<h4>Jurado por Proyecto</h4>',
                'id'     => 'modal',
                'size'   => 'modal-lg',
            ]);
            echo "<div id='modalContent'></div>";

            Modal::end();
            ?>
            <?php Pjax::begin(); ?>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel'  => $searchModel,
                //  'tableOptions'=>['class'=>'table-striped table-bordered table-condensed'],
                'options'      => ['style' => 'white-space:nowrap;'],
                'columns'      => [
                    ['class'         => 'yii\grid\SerialColumn',
                        'headerOptions' => ['style' => 'background-color:#ef7d2'],
                    ],
                    //  'idjurado0.nombre',
                    // 'idproyecto0.nombre',
                    // 'idjurado20.nombre',
                    [ // asi se establece un campo de otra tabla con el searching GridView
                        'attribute' => 'idjurado',
                        'value'     => 'idjurado0.nombre',
                    //'headerOptions' => ['style' => 'background-color:#0061a2', ],
                    ],
                    [ // asi se establece un campo de otra tabla con el searching GridView
                        'attribute' => 'idjurado2',
                        'value'     => 'idjurado20.nombre',
                    //'headerOptions' => ['style' => 'background-color:#0061a2'],
                    ],
                    [ // asi se establece un campo de otra tabla con el searching GridView
                        'attribute' => 'idproyecto',
                        'value'     => 'idproyecto0.nombre',
                    //'headerOptions' => ['style' => 'background-color:#0061a2'],
                    //'options' => [ 'style' => 'background-color:#0000FF'],
                    ],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>

    </div>
    <div class="panel-footer">
        <?= Html::button('Asignar jurado', ['value' => Url::to('index.php?r=jurado-has-proyecto/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
    </div>
</div>
<script>
    $(function ()
    {
        $('.summary').hide();
        $('table').attr('id', 'table_dpp');
        $('#table_dpp').DataTable(languaje());
    });
</script>
