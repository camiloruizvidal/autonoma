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
?>
<div class="conocimiento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            //'idconocimiento',
            'Titulo',
            'descripcion',
            'telefono',
            'correo',
        //    ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
