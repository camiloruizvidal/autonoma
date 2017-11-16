<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Modalidad */

$this->title = 'Actualizar Modalidad: ' . $model->idmodalidad;
$this->params['breadcrumbs'][] = ['label' => 'Modalidad', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmodalidad, 'url' => ['view', 'id' => $model->idmodalidad]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modalidad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
