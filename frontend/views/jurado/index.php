<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JuradoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Jurados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?php
        // se realiza una funcion para hacer un formulario mas bonito
        Modal::begin([
            'header' => '<h4>Jurados</h4>',
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
                //  'idjurado',
                'nombre',
            //  ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>
    <div class="panel-footer">
        <?= Html::button('Crear jurado', ['value' => Url::to('index.php?r=jurado/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
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
