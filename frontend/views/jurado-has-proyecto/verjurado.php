<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JuradoHasProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ver Jurado ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurado-has-proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Jurado',
            'Jurado2',
            'Proyecto',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
