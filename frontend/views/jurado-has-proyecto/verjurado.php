<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JuradoHasProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Ver Jurado ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">

        <div class="jurado-has-proyecto-index">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'Jurado',
                    'Jurado2',
                    'Proyecto',
                //['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="panel-footer">
    </div>
</div>