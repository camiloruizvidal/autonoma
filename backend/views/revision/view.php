<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Revision */

$this->title = $model->idrevision;
$this->params['breadcrumbs'][] = ['label' => 'Revisiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="revision-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Actulizar', ['update', 'id' => $model->idrevision], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idrevision], [
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
            'idrevision',
            'descripcion',
            'correccion',
            'archivo',
            'estado',
            'idanteproyecto',
        ],
    ]) ?>

</div>
