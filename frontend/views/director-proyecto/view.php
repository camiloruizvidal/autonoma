<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DirectorProyecto */

//$this->title = $model->iddirector_proyecto;
$this->params['breadcrumbs'][] = ['label' => 'Director Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="director-proyecto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->iddirector_proyecto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->iddirector_proyecto], [
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
          //'iddirector_proyecto',
            'nombre',
        ],
    ]) ?>

</div>
