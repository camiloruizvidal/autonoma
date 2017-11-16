<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Anteproyecto */

$this->title = $model->idanteproyecto;
//$this->params['breadcrumbs'][] = ['label' => 'Anteproyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anteproyecto-view">

    <h1><?= Html::encode($this->title) ?></h1>

  <!--  <p>
        <?= Html::a('Update', ['update', 'id' => $model->idanteproyecto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idanteproyecto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idanteproyecto',
            'nombre',
            'descripcion',
            //'archivo_anteproyecto',
            'idmodalidad0.nombre',
            //'id',
        ],
    ]) ?>

</div>
