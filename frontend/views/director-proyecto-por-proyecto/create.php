<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DirectorProyectoPorProyecto */

$this->title = 'Director Por Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Director Proyecto Por Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css"/>
<script>
$(function()
{
	$('#directorproyectoporproyecto-iddirector_proyecto').select2();
	$('#directorproyectoporproyecto-idproyecto').select2();
	
});
</script>
-->
<div class="director-proyecto-por-proyecto-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
