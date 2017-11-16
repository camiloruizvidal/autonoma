<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\JuradoHasProyecto */

$this->title = 'Update Jurado Has Proyecto: ' . $model->idjurado;
$this->params['breadcrumbs'][] = ['label' => 'Jurado Has Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idjurado, 'url' => ['view', 'idjurado' => $model->idjurado, 'idproyecto' => $model->idproyecto, 'idjurado2' => $model->idjurado2]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurado-has-proyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
