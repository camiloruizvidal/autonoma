<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\JuradoHasProyecto */

//$this->title = $model->idjurado;
$this->params['breadcrumbs'][] = ['label' => 'Jurado Has Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurado-has-proyecto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actulizar', ['update', 'idjurado' => $model->idjurado, 'idproyecto' => $model->idproyecto, 'idjurado2' => $model->idjurado2], ['class' => 'btn btn-primary']) ?>
      <!--  <?= Html::a('Delete', ['delete', 'idjurado' => $model->idjurado, 'idproyecto' => $model->idproyecto, 'idjurado2' => $model->idjurado2], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idproyecto0.nombre',
            'idjurado0.nombre',
            'idjurado20.nombre',
        ],
    ]) ?>

</div>
