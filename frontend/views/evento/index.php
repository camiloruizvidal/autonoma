<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Cronograma';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Nuevo evento</div>
                <form id="new_evento">
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <label>Fecha</label>
                                <input id="fecha_evento" name="fecha_evento" class="form form-control" required="true" />
                            </div>
                            <div class="col-md-12">
                                <label>Titulo</label>
                                <input id="titulo" name="titulo" class="form form-control" required="true" />
                            </div>
                            <div class="col-md-12">
                                <label>Descripcion</label>
                                <textarea rows="8" id="descripcion" name="descripcion" class="form form-control" required="true"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary">Guardando</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading"><?= Html::encode($this->title) ?></div>
                <div class="panel-body">
                    <script>
                        $(function ()
                        {
                            $('#fecha_evento').datepicker({dateFormat: "yy-mm-dd",minDate:'+0'});
                            $('#new_evento').submit(function (e)
                            {
                                e.preventDefault();
                                $.ajax({
                                    url: '../controllers/ajax/evento.php',
                                    data: $('#new_evento').serialize(),
                                    type: 'POST',
                                    success: function (e)
                                    {

                                    }
                                });
                            });
                        });
                    </script>

                    <?php
                    Modal::begin([
                        'header' => '<h4>Cronograma</h4>',
                        'id'     => 'modal',
                        'size'   => 'modal-lg',
                    ]);
                    echo "<div id='modalContent'></div>";
                    Modal::end();
                    ?>
                    <?=
                    \yii2fullcalendar\yii2fullcalendar::widget([
                        'options' => ['lang' => 'es',],
                        'events'  => $events,]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>