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
    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                <?php } ?>

                <?php Pjax::begin(); /* ?>
                  <?=
                  GridView::widget([
                  'dataProvider' => $dataProvider,
                  'filterModel'  => $searchModel,
                  'rowOptions'   => function($model)
                  {
                  if ($model->estado == 0 && Yii::$app->user->can('Secretario'))
                  {
                  return ['class' => 'danger'];
                  }
                  elseif ($model->estado == 1 && Yii::$app->user->can('Secretario'))
                  {
                  return ['class' => 'success'];
                  }
                  },
                  'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                  //'idanteproyecto',
                  [ // asi se establece un campo de otra tabla con el searching GridView
                  'attribute' => 'id',
                  'value'     => 'id0.username',
                  ],
                  'nombre',
                  'descripcion',
                  //'archivo_anteproyecto',
                  //'date_create',
                  //'id0.nombre',
                  [ // asi se establece un campo de otra tabla con el searching GridView
                  'attribute' => 'idmodalidad',
                  'value'     => 'idmodalidad0.nombre',
                  ],
                  [ 'visible'  => Yii::$app->user->can('Estudiante'),
                  'class'    => 'yii\grid\ActionColumn',
                  'template' => '{update}',
                  ],
                  [
                  'visible'  => Yii::$app->user->can('Secretario'),
                  'class'    => 'yii\grid\ActionColumn',
                  'template' => '{download}, {public}, {view}',
                  'buttons'  => [

                  'download' => function ($url, $model)
                  {
                  return Html::a(
                  Html::img('image/descarga.png', ['width' => '15']), ['anteproyecto/download', 'id' => $model->idanteproyecto], [
                  'title'     => 'Descargar',
                  'data-pjax' => '0',
                  ]
                  );
                  },
                  'public'   => function ($url, $model)
                  {
                  return Html::a(
                  Html::img('image/publicar.png', ['width' => '15']), ['anteproyecto/public', 'id' => $model->idanteproyecto], [
                  'title'     => 'Publicar',
                  'data-pjax' => '0',
                  ]
                  );
                  },
                  ],
                  ],
                  [
                  'visible'  => Yii::$app->user->can('Comite'),
                  'class'    => 'yii\grid\ActionColumn',
                  'template' => '{download1},  {view}',
                  'buttons'  => [
                  'download1' => function ($url, $model)
                  {
                  return Html::a(
                  Html::img('image/descarga.png', ['width' => '15']), ['anteproyecto/download1', 'id' => $model->idanteproyecto], [
                  'title'     => 'Descargar',
                  'data-pjax' => '0',
                  ]
                  );
                  },
                  ],
                  ],
                  ],
                  ]);
                  ?>
                  <?php Pjax::end(); */ ?>
                <div id="data"></div>
            </div>
        </div>

    </div>
</div>

<div class="anteproyecto-index">

</div>
