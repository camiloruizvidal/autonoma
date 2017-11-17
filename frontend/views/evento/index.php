<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Cronograma';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading"><?= Html::encode($this->title) ?></div>
            <div class="panel-body">
                <?php
                Modal::begin([
                    'header' => '<h4>Cronograma</h4>',
                    'id'     => 'modal',
                    'size'   => 'modal-lg',
                ]);
                echo "<div id='modalContent'></div>";
                Modal::end();
                ?>
                <?= \yii2fullcalendar\yii2fullcalendar::widget([
                    'options' => ['lang' => 'es',],
                    'events'  => $events,]);
                ?>
            </div>
        </div>
    </div>
</div>