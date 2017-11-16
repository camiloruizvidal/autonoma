<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php
    Modal::begin([
        'header' => '<h4>Documentos</h4>',
        'id'     => 'modal',
        'size'   => 'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";

    Modal::end();
    ?>
    <?php
    if (Yii::$app->user->can('Secretario'))
    {
        ?>
        <p>
            <?= Html::button('Subir Documento', ['value' => Url::to('index.php?r=documento/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
        </p>
    <?php } ?>
    <?php Pjax::begin(); ?>    
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombre',
            //  'archivo',
            [ 'visible'  => Yii::$app->user->isGuest,
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{download}',
                'buttons'  => [
                    'download' => function ($url, $model)
                    {
                        return Html::a(
                                        Html::img('image/descarga.png', ['width' => '15']), ['documento/download', 'id' => $model->iddocumento], [
                                    'title'     => 'Descargar',
                                    'data-pjax' => '0',
                                        ]
                        );
                    },],
                    ],
                    [ 'visible'  => Yii::$app->user->can('Estudiante'),
                        'class'    => 'yii\grid\ActionColumn',
                        'template' => '{download}',
                        'buttons'  => [
                            'download' => function ($url, $model)
                            {
                                return Html::a(
                                                Html::img('image/descarga.png', ['width' => '15']), ['documento/download', 'id' => $model->iddocumento], [
                                            'title'     => 'Descargar',
                                            'data-pjax' => '0',
                                                ]
                                );
                            },
                                ],
                            ],
                            [ 'visible'  => Yii::$app->user->can('Comite'),
                                'class'    => 'yii\grid\ActionColumn',
                                'template' => '{download}',
                                'buttons'  => [
                                    'download' => function ($url, $model)
                                    {
                                        return Html::a(
                                                        Html::img('image/descarga.png', ['width' => '15']), ['documento/download', 'id' => $model->iddocumento], [
                                                    'title'     => 'Descargar',
                                                    'data-pjax' => '0',
                                                        ]
                                        );
                                    },
                                        ],
                                    ],
                                    [ 'visible'  => Yii::$app->user->can('Jurado'),
                                        'class'    => 'yii\grid\ActionColumn',
                                        'template' => '{download}',
                                        'buttons'  => [
                                            'download' => function ($url, $model)
                                            {
                                                return Html::a(
                                                                Html::img('image/descarga.png', ['width' => '15']), ['documento/download', 'id' => $model->iddocumento], [
                                                            'title'     => 'Descargar',
                                                            'data-pjax' => '0',
                                                                ]
                                                );
                                            },
                                                ],
                                            ],
                                            [ 'visible'  => Yii::$app->user->can('Docente'),
                                                'class'    => 'yii\grid\ActionColumn',
                                                'template' => '{download}',
                                                'buttons'  => [
                                                    'download' => function ($url, $model)
                                                    {
                                                        return Html::a(
                                                                        Html::img('image/descarga.png', ['width' => '15']), ['documento/download', 'id' => $model->iddocumento], [
                                                                    'title'     => 'Descargar',
                                                                    'data-pjax' => '0',
                                                                        ]
                                                        );
                                                    },
                                                        ],
                                                    ],
                                                    [
                                                        'visible'  => Yii::$app->user->can('Secretario'),
                                                        'class'    => 'yii\grid\ActionColumn',
                                                        'template' => '{download}, {update}, {delete}',
                                                        'buttons'  => [
                                                            'download' => function ($url, $model)
                                                            {
                                                                return Html::a(
                                                                                Html::img('image/descarga.png', ['width' => '15']), ['documento/download', 'id' => $model->iddocumento], [
                                                                            'title'     => 'Descargar',
                                                                            'data-pjax' => '0',
                                                                                ]
                                                                );
                                                            },
                                                                ],
                                                            ],
                                                        ],
                                                    ]);
                                                    ?>
                                                    <?php Pjax::end(); ?></div>
