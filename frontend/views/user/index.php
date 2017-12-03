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
                    <?php $form                          = ActiveForm::begin(['id' => 'form-signup']); ?>
                    <div class="col-md-12">
                        <div class="form-group field-signupform-nombre required">
                            <label class="control-label" for="signupform-nombre">Nombre</label>
                            <input type="text" id="signupform-nombre" class="form-control" name="SignupForm[nombre]" autofocus aria-required="true" required="true"/>
                            <p class="help-block help-block-error"></p>
                        </div>     
                    </div>
                    <div class="col-md-12">
                        <div class="form-group field-signupform-apellido required">
                            <label class="control-label" for="signupform-apellido">Apellido</label>
                            <input type="text" id="signupform-apellido" class="form-control" name="SignupForm[apellido]" aria-required="true" required="true"/>
                            <p class="help-block help-block-error"></p>
                        </div>    
                    </div>
                    <div class="col-md-12">
                        <div class="form-group field-signupform-codigo_estudiantil">
                            <label class="control-label" for="signupform-codigo_estudiantil">Identificacion</label>
                            <input type="text" id="signupform-codigo_estudiantil" class="form-control" name="SignupForm[codigo_estudiantil]" required="true"/>

                            <p class="help-block help-block-error"></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group field-signupform-facultad required">
                            <label class="control-label" for="signupform-facultad">Programa</label>
                            <select id="signupform-facultad" class="form-control" name="SignupForm[facultad]" aria-required="true" required="true">
                                <option>selecciones una facultad</option>
                                <option value="Ing. Sistemas informatico">Ing. Sistemas informatico</option>
                                <option value="Ing. Ambiental">Ing. Ambiental</option>
                                <option value="Ing. Electronica">Ing. Electronica</option>
                            </select>

                            <p class="help-block help-block-error"></p>
                        </div>            
                    </div>
                    <div class="col-md-12">
                        <div class="form-group field-signupform-username required">
                            <label class="control-label" for="signupform-username">Nombre de Usuario</label>
                            <input type="text" id="signupform-username" class="form-control" name="SignupForm[username]" aria-required="true" required="true"/>
                            <p class="help-block help-block-error"></p>
                        </div>            
                    </div>
                    <div class="col-md-12">
                        <div class="form-group field-signupform-email required">
                            <label class="control-label" for="signupform-email">Email</label>
                            <input type="email" id="signupform-email" class="form-control" name="SignupForm[email]" aria-required="true" required="true"/>
                            <p class="help-block help-block-error"></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group field-signupform-password required">
                            <label class="control-label" for="signupform-password">Contraseña</label>
                            <input type="password"  id="signupform-password" class="form-control" name="SignupForm[password]" aria-required="true" required="true"/>
                            <p class="help-block help-block-error"></p>
                        </div>            
                    </div>
                    <div class="col-md-12">
                        <!-- se utiliza el arrayhelper para buscar los roles que existen en la tabla authitem -->
                        <div class="form-group field-signupform-permissions">
                            <label class="control-label">Rol</label>
                            <input type="hidden" name="SignupForm[permissions]" value="">
                            <div id="signupform-permissions">
                                <div class="checkbox">
                                    <label><input class="roles"  type="checkbox" name="SignupForm[permissions][]" value="Comite" id="Comite"> Comite</label>
                                </div>
                                <div class="checkbox">
                                    <label><input class="roles" type="checkbox" name="SignupForm[permissions][]" value="Docente" id="Docente"> Docente</label>
                                </div>
                                <div class="checkbox">
                                    <label><input class="roles" type="checkbox" name="SignupForm[permissions][]" value="Estudiante" id="Estudiante"> Estudiante</label>
                                </div>
                                <div class="checkbox">
                                    <label><input class="roles" type="checkbox" name="SignupForm[permissions][]" value="Jurado" id="Jurado"> Jurado</label>
                                </div>
                                <div class="checkbox">
                                    <label><input class="roles" type="checkbox" name="SignupForm[permissions][]" value="Secretario" id="Secretario"> Secretario</label>
                                </div>
                            </div>
                            <p class="help-block help-block-error"></p>
                        </div>            
                    </div>
                    <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    <?php ActiveForm::end(); ?>
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