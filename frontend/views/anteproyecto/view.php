<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Anteproyecto */

//$this->title = $model->idanteproyecto;
$this->params['breadcrumbs'][] = ['label' => 'Anteproyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-body">
        <div class="anteproyecto-view">
            <h1><?= Html::encode($this->title) ?></h1>

            <?=
            DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    'nombre',
                    'descripcion',
                    'objetivos',
                    'planteamiento_problema',
                    'justificacion',
                    //'archivo_anteproyecto',
                    'idmodalidad0.nombre',
                //'id',
                ],
            ])
            ?>

        </div>
    </div>
    <div class="panel-footer">
        <?= Html::a('Actualizar', ['update', 'id' => $model->idanteproyecto], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Borrar', ['delete', 'id' => $model->idanteproyecto], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => '¿En verdad desea borrar este anteproyecto?',
                'method'  => 'post',
            ],
        ])
        ?>
    </div>
</div>
