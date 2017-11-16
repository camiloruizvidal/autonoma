<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Jurado */

$this->title = 'Actualizar Jurado: ' . $model->idjurado;
$this->params['breadcrumbs'][] = ['label' => 'Jurados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idjurado, 'url' => ['view', 'id' => $model->idjurado]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
