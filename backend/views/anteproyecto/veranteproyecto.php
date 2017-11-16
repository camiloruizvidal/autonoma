<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AnteproyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anteproyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anteproyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
      Modal::begin([
          'header' => '<h4>Anteproyecto</h4>',
          'id' => 'modal',
          'size' => 'modal-lg',
      ]);
      echo "<div id='modalContent'></div>";

      Modal::end();
    ?>
    <p>
        <?= Html::button('Crear Anteproyecto', ['value'=>Url::to('index.php?r=anteproyecto/create'),'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
    </p>

    <?php  Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],
          /*   [ // asi se establece un campo de otra tabla con el searching GridView
             'attribute' => 'idmodalidad',
              'value' =>     'idmodalidad0.nombre',
            ], */

            //'idanteproyecto',
            'Titulo',
            'descripcion',
            'archivo_anteproyecto',
            'Modalidad',

            //'id',

        //   ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
