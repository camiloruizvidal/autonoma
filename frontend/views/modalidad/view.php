<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Modalidad */

//$this->title = $model->idmodalidad;
$this->params['breadcrumbs'][] = ['label' => 'Modalidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modalidad-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idmodalidad], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idmodalidad], [
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
          //  'idmodalidad',
            'nombre',
            'descripcion',
        ],
    ]) ?>

</div>
