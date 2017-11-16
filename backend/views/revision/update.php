<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Revision */

$this->title = 'Actualizar Revision: ' . $model->idrevision;
$this->params['breadcrumbs'][] = ['label' => 'Revisiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idrevision, 'url' => ['view', 'id' => $model->idrevision]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="revision-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
