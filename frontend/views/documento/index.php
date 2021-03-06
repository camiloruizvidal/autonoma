<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
$ds                            = DIRECTORY_SEPARATOR;
include_once dirname(__FILE__) . $ds . '..' . $ds . '..' . $ds . 'controllers' . $ds . 'ajax' . $ds . 'conexion.php';
$sql                           = 'SELECT 
                                        `documento_tipo`.`id_documento_tipo`,
                                        `documento_tipo`.`descripcion`
                                      FROM
                                        `documento_tipo`
                                        ORDER BY
                                        `documento_tipo`.`descripcion`';
$data                          = conexion::records($sql);
$option                        = '';
foreach ($data as $temp)
{
    $option.= '<option value="' . $temp['id_documento_tipo'] . '">' . $temp['descripcion'] . '</option>';
}
?>
<script src="js/documento.js<?php echo '?v=' . date('YmdHis'); ?>"></script>
<script src="js/jquery/jquery-ui.min.js"></script>
<link href="css/jquery/jquery-ui.css" rel="stylesheet"/>
<div class="col-md-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Buscar
        </div>
        <div class="panel-body">
            <form id="search">
                <div class="container-alt">
                    <div class="col-xs-12">
                        <label>Coincidencia</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre">
                            <span class="input-group-btn">
                                <button onclick="limpiar('#nombre');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                    <div class="col-xs-6">
                        <label>Fecha inicio</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="inicio" id="inicio" placeholder="Fecha de inicio">
                            <span class="input-group-btn">
                                <button onclick="limpiar('#inicio');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                    <div class="col-xs-6">
                        <label>Fecha fin</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="fin" id="fin" placeholder="Fecha de fin">
                            <span class="input-group-btn">
                                <button onclick="limpiar('#fin');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                    <div class="col-xs-12">
                        <label>Tipo de documentos</label>
                        <div class="input-group">
                            <select class="form form-control" onchange="tabla();" name="id_tipo_documento" id="id_tipo_documento">
                                <option value="-1">Todos</option>
                                <?php
                                echo $option;
                                ?>
                            </select>
                            <span class="input-group-btn">
                                <button onclick="limpiar('#id_tipo_documento');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-8">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <div class="documento-index">

                <?php
                Modal::begin([
                    'header' => '<h4>Nuevo documento</h4>',
                    'id'     => 'modal',
                    'size'   => 'modal-lg',
                ]);
                echo "<div id='modalContent'></div>";

                Modal::end();
                ?>
                <?php
                if (Yii::$app->user->can('Secretario'))
                {
                    ?>
                    <p>
                        <button type="button" id="modalButton" class="btn btn-primary" value="index.php?r=documento/create">Subir Documento</button>
                    </p>
                <?php } ?>

                <div id="data">
                </div>
            </div>
        </div>
    </div>
</div>
