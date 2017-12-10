<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RevisionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Concepto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <div class="revision-index">
            <?php
            Modal::begin([
                'header' => '<h4>Conceptos</h4>',
                'id'     => 'modal',
                'size'   => 'modal-lg',
            ]);
            echo "<div id='modalContent'></div>";
            Modal::end();
            ?>
            <?php
            if (Yii::$app->user->can('Comite'))
            {
                ?>
                <p>
                    <?= Html::button('Crear Concepto', ['value' => Url::to('index.php?r=revision/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>

                </p>
            <?php } ?>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'idrevision',
                    'descripcion',
                    'correccion',
                    //'archivo',
                    'estado',
                    'date_create',
                    'num_revisiones',
                    // 'idanteproyecto',
                    [
                        'visible'  => Yii::$app->user->can('Estudiante'),
                        'class'    => 'yii\grid\ActionColumn',
                        'template' => '{download}',
                        'buttons'  => [
                            'download' => function ($url, $model)
                            {
                                return Html::a(
                                                Html::img('image/descarga.png', ['width' => '15']), ['revision/download', 'id' => $model->idrevision], [
                                            'title'     => 'Descargar',
                                            'data-pjax' => '0',
                                                ]
                                );
                            },
                                ],
                            ],
                            [
                                'visible'  => Yii::$app->user->can('Comite'),
                                'class'    => 'yii\grid\ActionColumn',
                                'template' => '{update}',
                            ],
                        ],
                    ]);
                    ?>
        </div>
    </div>
</div>