<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use frontend\models\Revision;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AnteproyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Anteproyectos';
$this->params['breadcrumbs'][] = $this->title;

//echo '<pre>';var_dump($this);exit;
?>
<link href="css/jquery/jquery-ui.min.css" rel="stylesheet"/>
<script src="js/jquery/jquery-ui.min.js"></script>
<script src="js/anteproyecto.js"></script>
<style>
    table.dataTable tbody th, table.dataTable tbody td{
        padding: 1px 1px;
    }
</style>
<div class="container-fluid">

    <?php
    if (Yii::$app->user->can('Estudiante'))
    {
        ?>
        <form id="search">
            <input type="hidden" id="id_estudiante" name="id_estudiante" value="<?php echo Yii::$app->user->id; ?>"/>
        </form>
        <?php
    } else
    {
        ?>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Buscar <?= Html::encode($this->title) ?>
                </div>
                <div class="panel-body">
                    <form id="search">
                        <div class="col-xs-12">
                            <label>Estudiante</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre">
                                <span class="input-group-btn">
                                    <button onclick="limpiar('#nombre');" class="btn btn-danger" type="button">x</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <label>Proyecto o radicado</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="proyecto" id="proyecto" placeholder="nombre">
                                <span class="input-group-btn">
                                    <button onclick="limpiar('#proyecto');" class="btn btn-danger" type="button">x</button>
                                </span>
                            </div>
                        </div>
                        <?php
                        if (Yii::$app->user->can('Comite'))
                        {
                            echo '<div class="col-xs-12">
                                    <input type="hidden" value="1" name="activo" id="activo"/>
                                    <label>Tipo</label>
                                    <div class="input-group">
                                        <select class="form-control" name="idmodalidad" id="idmodalidad">
                                            <option value="-1">TODOS</option>
                                            <option value="2">trabajo de Investigacion</option>
                                            <option value="1">pasantia</option>
                                        </select>
                                        <span class="input-group-btn">
                                            <button onclick="limpiar(\'#idmodalidad\');" class="btn btn-danger" type="button">x</button>
                                        </span>
                                    </div>
                                </div>';
                        } else
                        {
                            echo '<div class="col-xs-6">
                                    <label>Tipo</label>
                                    <div class="input-group">
                                        <select class="form-control" name="idmodalidad" id="idmodalidad">
                                            <option value="-1">TODOS</option>
                                            <option value="2">trabajo de Investigacion</option>
                                            <option value="1">pasantia</option>
                                        </select>
                                        <span class="input-group-btn">
                                            <button onclick="limpiar(\'#idmodalidad\');" class="btn btn-danger" type="button">x</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Publicados</label>
                                    <div class="input-group">
                                        <select class="form-control" name="activo" id="activo">
                                            <option value="-1">TODOS</option>
                                            <option value="1">SI</option>
                                            <option value="0">NO</option>
                                        </select>
                                        <span class="input-group-btn">
                                            <button onclick="limpiar(\'#activo\');" class="btn btn-danger" type="button">x</button>
                                        </span>
                                    </div>
                                </div>';
                        }
                        ?>
                        <div class="col-md-6">
                            <label>Fecha inicio</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="inicio" id="inicio" placeholder="YYYY-mm-dd">
                                <span class="input-group-btn">
                                    <button onclick="limpiar('#inicio');" class="btn btn-danger" type="button">x</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Fecha fin</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="fin" id="fin" placeholder="YYYY-mm-dd">
                                <span class="input-group-btn">
                                    <button onclick="limpiar('#fin');" class="btn btn-danger" type="button">x</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
}
?>
    <?php
    if (Yii::$app->user->can('Estudiante'))
    {
        echo '<div class="col-md-12">';
    } else
    {
        echo '<div class="col-md-12">';
    }
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
    <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]);      ?>

            <?php
            Modal::begin([
                'header' => '<h4>Anteproyecto</h4>',
                'id'     => 'modal',
                'size'   => 'modal-lg',
            ]);
            echo "<div id='modalContent'></div>";

            Modal::end();
            ?>
            <?php
            $model = new Revision();
            if (Yii::$app->user->can('Estudiante'))
            {
                ?>
                <p>
                <?php
                $sql       = "SELECT 
                    COALESCE(`revision`.`estado`, 'No ha sido revisado') as cantidad
                  FROM
                    `user`
                    INNER JOIN `anteproyecto` ON (`user`.`id` = `anteproyecto`.`id`)
                    INNER JOIN `modalidad` ON (`anteproyecto`.`idmodalidad` = `modalidad`.`idmodalidad`)
                    LEFT OUTER JOIN `revision` ON (`anteproyecto`.`idanteproyecto` = `revision`.`idanteproyecto`)
                    WHERE
                    `user`.`id`=" . Yii::$app->user->id . "
                        AND
                    (`revision`.`estado`='Aceptado'
                    OR
                    `revision`.`estado`='Corrección'
                    OR
                    COALESCE(`revision`.`estado`, 'No ha sido revisado')='No ha sido revisado')
                      ";
                $sql2      = "SELECT 
  COALESCE(`revisonp`.`estado`, 'No ha sido revisado') AS `cantidad`
FROM
  `revisonp`
  INNER JOIN `proyecto` ON (`revisonp`.`idproyecto` = `proyecto`.`idproyecto`)
WHERE
  `proyecto`.`id` = " . Yii::$app->user->id . " AND 
  (`revisonp`.`estado` = 'Corrección' OR 
  `revisonp`.`estado` = 'Aceptado')";
                $download  = Yii::$app->db->createCommand($sql)->queryAll();
                $download1 = Yii::$app->db->createCommand($sql2)->queryAll();
                if (count($download) < 1 && count($download1) < 1)
                {
                    echo Html::button('Crear Anteproyecto', ['value' => Url::to('index.php?r=anteproyecto/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton']);
                }
                ?>
                </p>
                    <?php
                }
                ?>
            <div id="data"></div>
            <?php Pjax::begin(); ?>
        </div>
    </div>
</div>
</div>
