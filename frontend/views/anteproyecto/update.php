<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Anteproyecto */

//$this->title = 'Actualizar Anteproyecto: ' . $model->idanteproyecto;
$this->params['breadcrumbs'][] = ['label' => 'Anteproyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idanteproyecto, 'url' => ['view', 'id' => $model->idanteproyecto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/tinymce.jquery.min.js" type="text/javascript"></script>
<link href="css/tinyeditor.css" rel="stylesheet" type="text/css"/>
<script>
    $(function ()
    {
        tinymce.init({
            selector: "textarea",
            theme: "modern",
            height: 500});
    });
</script>
<div class="panel panel-primary">
    <div class="panel-heading">
        Actualizando anteproyecto
    </div>
    <div class="panel-body">
        <div class="anteproyecto-update">

            <h1><?= Html::encode($this->title) ?></h1>
            <?=
            $this->render('_form1', [
                'model' => $model,
            ])
            ?>