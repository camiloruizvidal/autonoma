<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Revisonp */

$this->title = $model->idrevisonp;
$this->params['breadcrumbs'][] = ['label' => 'Revisiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="revisonp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('actualizar', ['update', 'id' => $model->idrevisonp], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idrevisonp], [
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
            //'idrevisonp',
            'descripcion',
            'correccion',
            'archivo',
            'estado',
          //  'idproyecto',
        ],
    ]) ?>

</div>
