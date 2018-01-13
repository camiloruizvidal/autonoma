<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title                   = 'Revisiones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <div class="revisonp-index">

            <?php
            if (Yii::$app->user->can('Secretario'))
            {
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel'  => $searchModel2,
                    'columns'      => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'idrevisonp',
                        'descripcion',
                        'correccion',
                        //'archivo',
                        'estado',
                        //'num_revisiones',
                        //$aprobar,
                        // 'idproyecto',
                        ['visible'  => Yii::$app->user->can('Secretario'),
                            'class'    => 'yii\grid\ActionColumn',
                            'template' => ' {update}',
                        ],
                    ],
                ]);
            }
            else
            {
                Modal::begin([
                    'header' => '<h4>Conceptos</h4>',
                    'id'     => 'modal',
                    'size'   => 'modal-lg',
                ]);
                echo "<div id='modalContent'></div>";
                Modal::end();
                ?>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel'  => $searchModel2,
                    'columns'      => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'idrevisonp',
                        'descripcion',
                        'correccion',
                        'archivo',
                        'estado',
                        'num_revisiones',
                        //$aprobar,
                        // 'idproyecto',
                        ['visible'  => Yii::$app->user->can('Estudiante'),
                            'class'    => 'yii\grid\ActionColumn',
                            'template' => '  {download}',
                            'buttons'  =>
                            [
                                'download' => function ($url, $model)
                                {
                                    return Html::a(
                                                    Html::img('image/descarga.png', ['width' => '15']), ['revisionp/download', 'id' => $model->idrevisonp], [
                                                'title'     => 'Descargar',
                                                'data-pjax' => '0',
                                                    ]
                                    );
                                },
                                    ],
                                ],
                                ['visible'  => Yii::$app->user->can('Jurado'),
                                    'class'    => 'yii\grid\ActionColumn',
                                    'template' => ' {update}',
                                ],
                            ],
                        ]);
                        ?>
                    </div>
                </div>
                <?php
            }
            if (Yii::$app->user->can('Jurado'))
            {
                echo '<div class = "panel-footer">';
                ?>
                <p>
                    <?= Html::button('Crear Revisión', ['value' => Url::to('index.php?r=revisionp/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>

                </p>
                <?php
                echo '</div>';
            }
            ?>
</div>