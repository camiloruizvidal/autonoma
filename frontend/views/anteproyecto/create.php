<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Anteproyecto */

$this->title = 'Crear Anteproyecto';
$this->params['breadcrumbs'][] = ['label' => 'Anteproyectos', 'url' => ['veranteproyecto']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anteproyecto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
