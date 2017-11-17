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
?>

<script src="js/documento.js<?php echo '?v=' . date('YmdHis'); ?>"></script>
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
                                <button onkeyup="search();" class="btn btn-danger" type="button">x</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                    <div class="col-xs-12">
                        <label>Tipo de documentos</label>
                        <div class="input-group">
                            <select class="form form-control">
                                <option value="">Todos</option>
                                <option value="">Resolucion</option>
                                <option value="">Oficio</option>
                                <option value="">Formatos</option>
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button">x</button>
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
