<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DirectorProyecto */

$this->title = 'Actualizar Director Proyecto: ' . $model->iddirector_proyecto;
$this->params['breadcrumbs'][] = ['label' => 'Director Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddirector_proyecto, 'url' => ['view', 'id' => $model->iddirector_proyecto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="director-proyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
