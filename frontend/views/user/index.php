<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

$this->title                   = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="js/usuario.js"></script>
<style>
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
        color:#000;}
    .nav-tabs > li > a {
        color: #FFF;
    }
</style>
<div class="col-md-4">
    <div class="panel panel-primary">

        <div class="panel-heading">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#regs" aria-controls="regs" role="tab" data-toggle="tab">Registrar</a></li>
                <li role="presentation"><a href="#filter" aria-controls="filter" role="tab" data-toggle="tab">Buscar</a></li>
            </ul>
        </div>
        <div class="panel-body">
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="regs">
                    <iframe src="index.php?r=site%2Fsignup" style="height: 880px;" frameborder="0"  scrolling="no"></iframe>
                </div>
                <div role="tabpanel" class="tab-pane" id="filter">
                    <form id="search">
                        <div class="container-alt">
                            <div class="col-md-12">
                                <label>Usuario</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre">
                                    <span class="input-group-btn">
                                        <button onclick="limpiar('#nombre');" class="btn btn-danger" type="button">x</button>
                                    </span>
                                </div><!-- /input-group -->
                            </div>
                            <div class="col-md-12">
                                <label>Documento</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="documento" id="documento" >
                                    <span class="input-group-btn">
                                        <button onclick="limpiar('#documento');" class="btn btn-danger" type="button">x</button>
                                    </span>
                                </div><!-- /input-group -->
                            </div>
                            <div class="col-md-12">
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
                            <div class="col-md-12">
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
                            <div class="col-md-12">
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
            </div>
        </div>
    </div>
</div>
<div class="col-md-8">
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
</div>