<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SustentacionFinal */

$this->title = $model->idsustentacion_final;
$this->params['breadcrumbs'][] = ['label' => 'Sustentacion Final', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sustentacion-final-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('actualizar', ['update', 'id' => $model->idsustentacion_final], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idsustentacion_final], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro que quiere eliminar este items?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idsustentacion_final',
            'fecha',
            'idproyecto',
        ],
    ]) ?>

</div>
