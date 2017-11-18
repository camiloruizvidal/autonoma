<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NovedadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Novedades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <div class="novedades-index">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php
            // se realiza una funcion para hacer un formulario mas bonito
            Modal::begin([
                'header' => '<h4>Novedades</h4>',
                'id'     => 'modal',
                'size'   => 'modal-lg',
            ]);
            echo "<div id='modalContent'></div>";

            Modal::end();
            ?>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'idnovedades',
                    'descripcion',
                    'fecha',
                    'idproyecto0.nombre',
                    ['visible' => Yii::$app->user->can('Secretario'),
                        'class'   => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>

    </div>
    <div class="panel-footer">
        <?php
        if (Yii::$app->user->can('Secretario'))
        {
            ?>
            <?= Html::button('Crear Novedad', ['value' => Url::to('index.php?r=novedades/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
        <?php } ?>
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
