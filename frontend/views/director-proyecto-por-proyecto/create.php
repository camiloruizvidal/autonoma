<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DirectorProyectoPorProyecto */

$this->title                   = 'Director Por Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Director Proyecto Por Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="director-proyecto-por-proyecto-create">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>
</div>