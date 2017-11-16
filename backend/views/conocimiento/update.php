<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Conocimiento */

$this->title = 'Actualizar Proyecto: ' . $model->idconocimiento;
$this->params['breadcrumbs'][] = ['label' => 'Banco de proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idconocimiento, 'url' => ['view', 'id' => $model->idconocimiento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="conocimiento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
