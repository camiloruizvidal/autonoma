<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'iddocumento',
            'nombre',
          //  'archivo',

          [
           'class' => 'yii\grid\ActionColumn',
           'template' => '{download}',
           'buttons' => [
                      'download' => function ($url, $model) {
                   return Html::a(
                        Html::img('image/descarga.png',['width' => '15']),
                       ['documento/download', 'id' => $model->iddocumento],
                       [
                           'title' => 'Descargar',
                           'data-pjax' => '0',
                       ]
                   );
               },
             ],
          ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
