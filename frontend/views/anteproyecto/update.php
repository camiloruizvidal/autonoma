<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Anteproyecto */

//$this->title = 'Actualizar Anteproyecto: ' . $model->idanteproyecto;
$this->params['breadcrumbs'][] = ['label' => 'Anteproyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idanteproyecto, 'url' => ['view', 'id' => $model->idanteproyecto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anteproyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
    ]) ?>

</div>
