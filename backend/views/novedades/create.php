<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Novedades */

$this->title = 'Crear Novedade';
$this->params['breadcrumbs'][] = ['label' => 'Novedades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
