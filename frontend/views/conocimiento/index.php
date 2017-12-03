<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ConocimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Banco de Proyectos';
$this->params['breadcrumbs'][] = $this->title;
$ds                            = DIRECTORY_SEPARATOR;
include_once dirname(__FILE__) . $ds . '..' . $ds . '..' . $ds . 'controllers' . $ds . 'ajax' . $ds . 'conexion.php';
$sql                           = 'SELECT 
  `programas`.`id_programas`,
  `programas`.`descripcion`
FROM
  `programas`
ORDER BY
`programas`.`descripcion`';
$data                          = conexion::records($sql);
$option                        = '';
$option                        = '<option value="-1">Todos</option>';
foreach ($data as $temp)
{
    $option.= '<option value="' . $temp['id_programas'] . '">' . $temp['descripcion'] . '</option>';
}
// se realiza una funcion para hacer un formulario mas bonito
Modal::begin([
    'header' => '<h4>Banco de Proyectos</h4>',
    'id'     => 'modal',
    'size'   => 'modal-lg',
]);
echo "<div id='modalContent'></div>";

Modal::end();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css"/>
<script src="js/conocimiento.js<?php echo '?v=' . date('YmdHis'); ?>"></script>

<div class="conocimiento-index">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <div class="col-md-4">
                <label>Tipo de programa</label>
                <select class="form form-control">
                    <?php
                    echo $option;
                    ?>
                </select>
            </div>
            <br/>
            <div id="data"></div>
        </div>
        <div class="panel-footer">
            <?= Html::button('Crear proyecto', ['value' => Url::to('index.php?r=conocimiento/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
        </div>
    </div>
</div>
