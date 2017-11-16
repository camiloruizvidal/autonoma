<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\JuradoHasProyecto */

$this->title = 'Asignar Jurado ';
$this->params['breadcrumbs'][] = ['label' => 'Jurado por Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurado-has-proyecto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
