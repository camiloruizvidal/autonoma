<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    function rendertabla()
    {
        $('#table_usuarios').DataTable(languaje());
    }
    function tabla()
    {
        $.ajax({
            url: '../controllers/ajax/usuarios.php',
            type: 'post',
            //data: $('#search').serialize(),
            success: function (data) {
                $('#data').html(data);
                rendertabla();
            }
        });
    }
    $(function ()
    {
        tabla();
    });
</script>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Filtros
        </div>
        <div class="panel-body">

        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <div id="data">
            </div>
        </div>
        <div class="panel-footer">
        </div>
    </div>
</div>