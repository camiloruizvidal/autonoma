<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Documento */


$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->iddocumento], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->iddocumento], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method'  => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'nombre',
        ],
    ])
    ?>

</div>
