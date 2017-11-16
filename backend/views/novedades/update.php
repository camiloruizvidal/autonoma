<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Novedades */

$this->title = 'Actualizar Novedad: ' . $model->idnovedades;
$this->params['breadcrumbs'][] = ['label' => 'Novedades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idnovedades, 'url' => ['view', 'id' => $model->idnovedades]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="novedades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
