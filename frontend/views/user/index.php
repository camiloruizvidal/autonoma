<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="js/usuario.js"></script>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Filtros
        </div>
        <div class="panel-body">
            <form id="search">
                <div class="container-alt">
                    <div class="col-md-6">
                        <label>Usuario</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre">
                            <span class="input-group-btn">
                                <button onclick="limpiar('#nombre');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                    <div class="col-md-6">
                        <label>Documento</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="documento" id="documento" >
                            <span class="input-group-btn">
                                <button onclick="limpiar('#documento');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                    <div class="col-md-4">
                        <label>Programa</label>
                        <div class="input-group">
                            <select class="form-control" name="programa" id="programa" placeholder="programa">
                                <option value="-1">Todos</option>
                                <option value="Ing. Sistemas informatico">Ing. Sistemas informatico</option>
                                <option value="Ing. Electronica">Ing. Electronica</option>
                                <option value="Ing. Ambiental">Ing. Ambiental</option>
                            </select>
                            <span class="input-group-btn">
                                <button onclick="limpiar('#programa');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                    <div class="col-md-4">
                        <label>Estado</label>
                        <div class="input-group">
                            <select class="form form-control" onchange="tabla();" name="estado" id="estado">
                                <option value="-1">Todos</option>
                                <option value="0">Activo</option>
                                <option value="1">No Activo</option>
                            </select>                                
                            <span class="input-group-btn">
                                <button onclick="limpiar('#estado');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                    <div class="col-md-4">
                        <label>Rol</label>
                        <div class="input-group">
                            <select class="form form-control" onchange="tabla();" name="rol" id="rol">
                                <option value="-1">Todos</option>
                                <option value="Comite">Comite</option>
                                <option value="Docente">Docente</option>
                                <option value="Estudiante">Estudiante</option>
                                <option value="Jurado">Jurado</option>
                                <option value="Secretario">Secretario</option>
                            </select>
                            <span class="input-group-btn">
                                <button onclick="limpiar('#rol');" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer">
            <a href="index.php?r=site%2Fsignup" class="btn btn-success"><i class="fa fa-user-plus" aria-hidden="true"></i> Registrar nuevo usuario</a>
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