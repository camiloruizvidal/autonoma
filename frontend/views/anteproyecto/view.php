<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Anteproyecto */

//$this->title = $model->idanteproyecto;
$this->params['breadcrumbs'][] = ['label' => 'Anteproyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">Anteproyectos</div>
    <div class="panel-body">
        <div class="anteproyecto-view">
            <h1><?= Html::encode($this->title) ?></h1>

            <?=
            DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    'nombre',
                    'descripcion',
                    'objetivos',
                    'planteamiento_problema',
                    'justificacion',
                    //'archivo_anteproyecto',
                    'idmodalidad0.nombre',
                //'id',
                ],
            ])
            ?>

        </div>
    </div>
    <div class="panel-footer">
        <?php
        if (Yii::$app->user->can('Secretario'))
        {
            echo '<a href = "index.php?r=anteproyecto%2Fpublic&amp;id=' . $_GET['id'] . '" title = "Publicar" aria-label = "Publicar" data-pjax = "0" data-confirm = "¿Esta seguro que desea publicar este proyecto?" data-method = "post"><button class="btn btn-warning"><span class = "glyphicon glyphicon-ok"></span> Publicar</button></a>';
            ?>
            <?=
            Html::a('Borrar', ['delete', 'id' => $model->idanteproyecto], [
                'class' => 'btn btn-danger',
                'data'  => [
                    'confirm' => '¿En verdad desea borrar este anteproyecto?',
                    'method'  => 'post',
        ]])
            ?>

            <?php
        }
        if (Yii::$app->user->can('Estudiante'))
        {
            ?>
            <?= Html::a('Actualizar', ['update', 'id' => $model->idanteproyecto], ['class' => 'btn btn-primary']) ?>
            <?php
        }
        ?>
<?php echo '<a style="color:#FFF;" href="index.php?r=anteproyecto%2Fdownload&amp;id=' . $_GET['id'] . '" title="Descargar" data-pjax="0"><button class="btn btn-success"><i class="glyphicon glyphicon-floppy-save"></i> Descargar</a></button>'; ?>
    </div>
</div>
