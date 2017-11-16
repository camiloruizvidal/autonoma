<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DirectorProyecto */

$this->title = 'Crear Director Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Director Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="director-proyecto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
