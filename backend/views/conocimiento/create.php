<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Conocimiento */

$this->title = 'Crear Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Banco de proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conocimiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
