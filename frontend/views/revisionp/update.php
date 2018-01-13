<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Revisonp */

$this->title                   = 'Actualizar Revisión';
$this->params['breadcrumbs'][] = ['label' => 'Revisiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idrevisonp, 'url' => ['view', 'id' => $model->idrevisonp]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="revisonp-update">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <?=
            $this->render('_form1', [
                'model' => $model,
            ])
            ?>

        