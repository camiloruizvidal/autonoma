<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Documento */

$this->title = 'Update Documento: ' . $model->iddocumento;
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddocumento, 'url' => ['view', 'id' => $model->iddocumento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="documento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
