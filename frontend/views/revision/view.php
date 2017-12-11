<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Revision */

//$this->title = $model->idrevision;
$this->params['breadcrumbs'][] = ['label' => 'Revisiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script>
    $(function ()
    {
        $('table tr td').each(function (index, value)
        {
            $(value).html($(value).text());
        });
    });
</script>
<div class="panel panel-primary">
    <div class="panel-heading">
        Revision
    </div>
    <div class="panel-body">


        <div class="revision-view">

            <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <!-- <?= Html::a('Actualizar', ['update', 'id' => $model->idrevision], ['class' => 'btn btn-primary']) ?>
                <?=
                Html::a('Eliminar', ['delete', 'id' => $model->idrevision], [
                    'class' => 'btn btn-danger',
                    'data'  => [
                        'confirm' => 'Esta seguro que quiere eliminar este items?',
                        'method'  => 'post',
                    ],
                ])
                ?> -->
            </p>

            <?=
            DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    //'idrevision',
                    'descripcion',
                    'correccion',
                    //'archivo',
                    'estado',
                    'idanteproyecto0.nombre',
                ],
            ])
            ?>

        </div>
    </div>
    <div class="panel-footer">
        <a href="#"><button class="btn btn-success">Descargar</button></a>
    </div>
</div>