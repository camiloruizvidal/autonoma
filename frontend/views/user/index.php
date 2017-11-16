<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'nombre',
            'apellido',
            'codigo_estudiantil',
            'facultad',
            // 'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
             'status',
             //'authAssignment.item_name',
             [ // asi se establece un campo de otra tabla con el searching GridView
               'attribute' => 'id',
               'value' =>     'authAssignment.item_name',
             ],
            // 'created_at',
            // 'updated_at',

            [ 'visible' => Yii::$app->user->can('Secretario'),
              'class' => 'yii\grid\ActionColumn',
              'template' => '{update}',
            ],
        ],
    ]); ?>
</div>
