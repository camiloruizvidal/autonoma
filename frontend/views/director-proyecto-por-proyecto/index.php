<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DirectorProyectoPorProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Director Por Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="director-proyecto-por-proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php

     // se realiza una funcion para hacer un formulario mas bonito
      Modal::begin([
          'header' => '<h4>Director por Proyecto</h4>',
          'id' => 'modal',
          'size' => 'modal-lg',
      ]);
      echo "<div id='modalContent'></div>";

      Modal::end();
    ?>
    <p>
        <?= Html::button('Asignar director', ['value'=>Url::to('index.php?r=director-proyecto-por-proyecto/create'),'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'iddirectorProyecto.nombre',
            'idproyecto0.nombre',
            

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
