<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use frontend\models\Revision;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AnteproyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Anteproyectos';
$this->params['breadcrumbs'][] = $this->title;

//echo '<pre>';var_dump($this);exit;
?>
<link href="css/jquery/jquery-ui.min.css" rel="stylesheet"/>
<script src="js/jquery/jquery-ui.min.js"></script>
<script src="js/anteproyecto.js"></script>
<style>
    table.dataTable tbody th, table.dataTable tbody td{
        padding: 1px 1px;
    }
</style>
<div class="container-fluid">
    
    <?php
    if (Yii::$app->user->can('Estudiante'))
    {    
    }
    else
    {
     ?>
             <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Buscar <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
                <form id="search">
                    <div class="col-xs-12">
                        <label>Estudiante</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre">
                            <span class="input-group-btn">
                                <button onclick="limpiar('#nombre');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <label>Proyecto</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="proyecto" id="proyecto" placeholder="nombre">
                            <span class="input-group-btn">
                                <button onclick="limpiar('#proyecto');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <label>Tipo</label>
                        <div class="input-group">
                            <select class="form-control" name="idmodalidad" id="idmodalidad">
                                <option value="-1">TODOS</option>
                                <option value="2">trabajo de Investigacion</option>
                                <option value="1">pasantia</option>
                            </select>
                            <span class="input-group-btn">
                                <button onclick="limpiar('#idmodalidad');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <label>Fecha inicio</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="inicio" id="inicio" placeholder="YYYY-mm-dd">
                            <span class="input-group-btn">
                                <button onclick="limpiar('#inicio');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
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
         <?php   
    }
    ?>
    <?php
    if (Yii::$app->user->can('Estudiante'))
    {
        echo '<div class="col-md-12">';
    }
    else
    {
        echo '<div class="col-md-8">';
    }
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

            <?php
            Modal::begin([
                'header' => '<h4>Anteproyecto</h4>',
                'id'     => 'modal',
                'size'   => 'modal-lg',
            ]);
            echo "<div id='modalContent'></div>";

            Modal::end();
            ?>
            <?php
            $model = new Revision();
            if (Yii::$app->user->can('Estudiante'))
            {
                ?>
                <p>
                    <?= Html::button('Crear Anteproyecto', ['value' => Url::to('index.php?r=anteproyecto/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
                </p>
                <?php
            }
            else
            {
                echo '<div id="data"></div>';
            }
            ?>

            <?php Pjax::begin(); ?>

        </div>
    </div>

</div>
</div>
