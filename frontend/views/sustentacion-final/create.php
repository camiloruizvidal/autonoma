<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SustentacionFinal */

$this->title = 'Crear Sustentación Final';
$this->params['breadcrumbs'][] = ['label' => 'Sustentacion Final', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sustentacion-final-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
