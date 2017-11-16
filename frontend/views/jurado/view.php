<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Jurado */

//$this->title = $model->idjurado;
$this->params['breadcrumbs'][] = ['label' => 'Jurados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurado-view">

    <h1><?= Html::encode($this->title) ?></h1>

  <!--  <p>
        <?= Html::a('Update', ['update', 'id' => $model->idjurado], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idjurado], [
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
          //  'idjurado',
            'nombre',
        ],
    ]) ?>

</div>
