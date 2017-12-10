<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Cronograma';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
            <?=
            \yii2fullcalendar\yii2fullcalendar::widget([
                'options' => [
                    'lang' => 'es',
                ],
                'events'  => $events,
                    ]
            );
            ?>

        </div>
    </div>
</div>
