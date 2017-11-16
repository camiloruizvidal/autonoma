<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Modalidad */

$this->title = 'Crear Modalidad';
$this->params['breadcrumbs'][] = ['label' => 'Modalidad', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modalidad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
