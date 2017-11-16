<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Proyecto */

$this->title = $model->idproyecto;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'idproyecto',
            'id0.nombre',
            'nombre',
            'descripcion',
            //'archivo_proyecto',
            'date_create',

        ],
    ]) ?>

</div>
