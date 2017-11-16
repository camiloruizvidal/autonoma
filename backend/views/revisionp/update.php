<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Revisonp */

$this->title = 'Actualizar Revison: ' . $model->idrevisonp;
$this->params['breadcrumbs'][] = ['label' => 'Revisiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idrevisonp, 'url' => ['view', 'id' => $model->idrevisonp]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="revisonp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
