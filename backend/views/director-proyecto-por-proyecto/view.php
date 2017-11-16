<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DirectorProyectoPorProyecto */

$this->title = $model->iddirector_proyecto;
$this->params['breadcrumbs'][] = ['label' => 'Director Proyecto Por Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="director-proyecto-por-proyecto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'iddirector_proyecto' => $model->iddirector_proyecto, 'idproyecto' => $model->idproyecto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'iddirector_proyecto' => $model->iddirector_proyecto, 'idproyecto' => $model->idproyecto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro que quiere eliminar este items?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'iddirectorProyecto.nombre',
            'idproyecto0.nombre',
        ],

    ]) ?>

</div>
