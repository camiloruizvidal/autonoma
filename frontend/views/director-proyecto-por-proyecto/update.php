<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DirectorProyectoPorProyecto */

$this->title = 'Update Director Proyecto Por Proyecto: ' . $model->iddirector_proyecto;
$this->params['breadcrumbs'][] = ['label' => 'Director Proyecto Por Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddirector_proyecto, 'url' => ['view', 'iddirector_proyecto' => $model->iddirector_proyecto, 'idproyecto' => $model->idproyecto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="director-proyecto-por-proyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
