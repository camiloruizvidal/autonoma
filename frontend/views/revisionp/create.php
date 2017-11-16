<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Revisonp */

$this->title = 'Crear Revisión';
$this->params['breadcrumbs'][] = ['label' => 'Revisiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="revisonp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
