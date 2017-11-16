<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SustentacionFinal */

$this->title = 'Actualizar Sustentacion Final: ' . $model->idsustentacion_final;
$this->params['breadcrumbs'][] = ['label' => 'Sustentacion Final', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idsustentacion_final, 'url' => ['view', 'id' => $model->idsustentacion_final]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sustentacion-final-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
