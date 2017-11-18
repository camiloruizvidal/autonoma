<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DirectorProyectoPorProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Director Por Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="director-proyecto-por-proyecto-index">
    <div class="panel panel-primary">
        <div class="panel-heading"><?= Html::encode($this->title) ?></div>
        <div class="panel-body">


            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php
            // se realiza una funcion para hacer un formulario mas bonito
            Modal::begin([
                'header' => '<h4>Director por Proyecto</h4>',
                'id'     => 'modal',
                'size'   => 'modal-lg',
            ]);
            echo "<div id='modalContent'></div>";

            Modal::end();
            ?>
            <p>

            </p>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'iddirectorProyecto.nombre',
                    'idproyecto0.nombre',
                ],
            ]);
            ?>
        </div>
        <div class="panel-footer">
            <?= Html::button('Asignar director', ['value' => Url::to('index.php?r=director-proyecto-por-proyecto/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
        </div>
    </div>
</div>
<script>
    $(function ()
    {
        $('.summary').hide();
        $('table').attr('id', 'table_dpp');
        $('#w0-filters').parent().html('<tr><th>#</th><th>Director de grado</th><th>Titulo</th></tr>');
        $('#table_dpp').DataTable(languaje());
    });
</script>