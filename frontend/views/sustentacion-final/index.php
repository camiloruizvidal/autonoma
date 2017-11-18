<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SustentacionFinalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Sustentación Final';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <div class="sustentacion-final-index">

            <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
            <?php
            // se realiza una funcion para hacer un formulario mas bonito
            Modal::begin([
                'header' => '<h4>Sustentación Final</h4>',
                'id'     => 'modal',
                'size'   => 'modal-lg',
            ]);
            echo "<div id='modalContent'></div>";

            Modal::end();
            ?>

            <!-- <?php
            echo Collapse::widget([
                'items' => [
                    [
                        'label'   => 'Buscar',
                        'content' => $this->render('_search', ['model' => $searchModel]),
                    ],
                ]
            ]);
            ?> -->
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'idsustentacion_final',
                    'lugar',
                    'fecha',
                    [ // asi se establece un campo de otra tabla con el searching GridView
                        'attribute' => 'idproyecto',
                        'value'     => 'idproyecto0.nombre',
                    ],
                    //['class' => 'yii\grid\CheckBoxColumn'],
                    ['visible' => Yii::$app->user->can('Secretario'),
                        'class'   => 'yii\grid\ActionColumn',]
                ],
            ]);
            ?>
        </div>

    </div>
    <?php
    if (Yii::$app->user->can('Secretario'))
    {
        ?>
        <div class="panel-footer">
            <?= Html::button('Crear Sustentación Final', ['value' => Url::to('index.php?r=sustentacion-final/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
        </div>
    <?php } ?>
</div>
<script>
    $(function ()
    {
        $('.summary').hide();
        $('table').attr('id', 'table_dpp');
        $('#table_dpp').DataTable(languaje());
    });
</script>
