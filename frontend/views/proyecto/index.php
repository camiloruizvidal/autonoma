<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="css/jquery/jquery-ui.min.css" rel="stylesheet"/>
<script src="js/jquery/jquery-ui.min.js"></script>
<script src="js/proyecto.js<?php echo '?v=' . date('YmdHis'); ?>"></script>
<style>
    table.dataTable tbody th, table.dataTable tbody td{
        padding: 1px 1px;
    }
    .container{
        max-width: 10000px !important;
    }
</style>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Buscar <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <form id="search">
                <div class="col-md-4">
                    <label>Estudiante</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre">
                        <span class="input-group-btn">
                            <button onclick="limpiar('#nombre');" class="btn btn-danger" type="button">x</button>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Proyecto</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="proyecto" id="proyecto" placeholder="nombre">
                        <span class="input-group-btn">
                            <button onclick="limpiar('#proyecto');" class="btn btn-danger" type="button">x</button>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Jurado</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="jurado" id="jurado" placeholder="nombre">
                        <span class="input-group-btn">
                            <button onclick="limpiar('#jurado');" class="btn btn-danger" type="button">x</button>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Publicados</label>
                    <div class="input-group">
                        <select class="form-control" name="activo" id="activo">
                            <option value="-1">TODOS</option>
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
                        <span class="input-group-btn">
                            <button onclick="limpiar('#activo');" class="btn btn-danger" type="button">x</button>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Fecha inicio</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="inicio" id="inicio" placeholder="YYYY-mm-dd">
                        <span class="input-group-btn">
                            <button onclick="limpiar('#inicio');" class="btn btn-danger" type="button">x</button>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Fecha fin</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="fin" id="fin" placeholder="YYYY-mm-dd">
                        <span class="input-group-btn">
                            <button onclick="limpiar('#fin');" class="btn btn-danger" type="button">x</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">

            <?php
            if (Yii::$app->user->can('Estudiante'))
            {
                ?>
                <p>
                    <?= Html::button('Crear Proyecto', ['value' => Url::to('index.php?r=proyecto/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>

                </p>
            <?php } ?>
            <div id="data"></div>
        </div>
    </div>
</div>
<?php
Modal::begin([
    'header' => '<h4>Proyecto</h4>',
    'id'     => 'modal',
    'size'   => 'modal-lg',
]);
echo "<div id='modalContent'></div>";

Modal::end();
?>