<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Proyecto */

$this->title = 'Actualizar Proyecto ';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idproyecto, 'url' => ['view', 'id' => $model->idproyecto]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="proyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>
<?php if (Yii::$app->user->can('Secretario')): ?>
  <?= $this->render('_form2', [
      'model' => $model,
  ]) ?>
<?php endif; ?>

<?php if (Yii::$app->user->can('Estudiante')): ?>
  <?= $this->render('_form1', [
      'model' => $model,
  ]) ?>
<?php endif; ?>
</div>
