<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\data\ArrayDataProvider;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="es-co">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Html::img('imagen/logo_plataforma.png', ['alt' => 'some', 'width' => '50', 'height' => '50']),
                'brandUrl'   => Yii::$app->homeUrl,
                'options'    => [
                    'class' => 'nav navbar-inverse navbar-fixed-top',
                    'style' => 'background-color:#0061a2',
                ],
            ]);
            $menuItems = [

                ['label'   => 'Jurado', 'options' => ['class' => 'estado_proyecto treeview-menu'], 'visible' => Yii::$app->user->can('Estudiante'), 'items'   => [
                        ['label' => 'Ver Jurados', 'url' => ['/jurado-has-proyecto/verjurado'], 'visible' => Yii::$app->user->can('Estudiante')],
                    ],
                ],
                ['label'   => 'Anteproyecto', 'options' => ['class' => 'treeview-menu'], 'visible' => Yii::$app->user->can('Secretario'), 'items'   => [
                        ['label' => 'Ver Anteproyectos', 'url' => ['/anteproyecto/index'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Asignar Concepto', 'url' => ['/revision/index'], 'visible' => Yii::$app->user->can('Comite')],
                    ],
                ],
                ['label'   => 'Anteproyecto', 'options' => ['class' => 'treeview-menu'], 'visible' => Yii::$app->user->can('Comite'), 'items'   => [
                        ['label' => 'Anteproyectos', 'url' => ['/anteproyecto/vercomite'], 'visible' => Yii::$app->user->can('Comite')],
                        ['label' => 'Asignar Concepto', 'url' => ['/revision/index'], 'visible' => Yii::$app->user->can('Comite')],
                    ],
                ],
                ['label'   => 'Anteproyecto', 'options' => ['class' => 'estado_anteproyecto treeview-menu'], 'visible' => Yii::$app->user->can('Estudiante'), 'items'   => [
                        ['label' => 'Ver Anteproyecto', 'url' => ['/anteproyecto/veranteproyecto'], 'visible' => Yii::$app->user->can('Estudiante')],
                        ['label' => 'Seguimiento', 'url' => ['/revision/seguimiento'], 'visible' => Yii::$app->user->can('Estudiante')],
                    ],
                ],
                ['label'   => 'Proyecto', 'options' => ['class' => 'treeview-menu'], 'visible' => Yii::$app->user->can('Jurado'), 'items'   => [
                        ['label' => 'Ver Proyecto', 'url' => ['/proyecto/verproyecto'], 'visible' => Yii::$app->user->can('Jurado')],
                        ['label' => 'Asignar Concepto', 'url' => ['/revisionp/index'], 'visible' => Yii::$app->user->can('Jurado')],
                    ],
                ],
                ['label'   => 'Proyecto', 'options' => ['class' => 'treeview-menu'], 'visible' => Yii::$app->user->can('Secretario'), 'items'   => [
                        ['label' => 'Ver Proyectos', 'url' => ['/proyecto/index'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Asignar director', 'url' => ['/director-proyecto-por-proyecto/index'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Asignar sustentacion', 'url' => ['/sustentacion-final/index'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Asignar Jurados', 'url' => ['/jurado-has-proyecto/index'], 'visible' => Yii::$app->user->can('Secretario')],
                    ],
                ],
                ['label'   => 'Proyecto', 'options' => ['class' => 'estado_proyecto treeview-menu'], 'visible' => Yii::$app->user->can('Estudiante'), 'items'   => [
                        ['label' => 'Ver Proyecto', 'url' => ['/proyecto/verproyecto'], 'visible' => Yii::$app->user->can('Estudiante')],
                        ['label' => 'Seguimiento', 'url' => ['/revisionp/seguimiento'], 'visible' => Yii::$app->user->can('Estudiante')],
                    ],
                ],
                ['label' => 'Cronograma', 'url' => ['/evento/index'], 'visible' => Yii::$app->user->can('Secretario')],
                ['label' => 'Cronograma', 'url' => ['/evento/cronograma'], 'visible' => Yii::$app->user->can('Estudiante')],
                ['label' => 'Cronograma', 'url' => ['/evento/cronograma'], 'visible' => Yii::$app->user->can('Docente')],
                ['label' => 'Cronograma', 'url' => ['/evento/cronograma'], 'visible' => Yii::$app->user->can('Comite')],
                // asi se estbalece que usuario puede ver que menu 'visible' => Yii::$app->user->can('Estudiante')
                ['label' => 'Banco de proyectos', 'url' => ['/conocimiento/index'], 'visible' => Yii::$app->user->can('Docente')],
                ['label' => 'Banco de proyectos', 'url' => ['/conocimiento/ver'], 'visible' => Yii::$app->user->can('Estudiante')],
                ['label' => 'Banco de proyectos', 'url' => ['/conocimiento/ver'], 'visible' => Yii::$app->user->can('Secretario')],
                ['label' => 'Banco de proyectos', 'url' => ['/conocimiento/ver'], 'visible' => Yii::$app->user->can('Comite')],
                ['label' => 'Banco de proyectos', 'url' => ['/conocimiento/ver'], 'visible' => Yii::$app->user->can('Jurado')],
                ['label' => 'Banco de proyectos', 'url' => ['/conocimiento/ver'], 'visible' => Yii::$app->user->isGuest],
                ['label' => 'Documentos', 'url' => ['/documento/index']],
                ['label'   => 'Reportes', 'options' => ['class' => 'treeview-menu'], 'visible' => Yii::$app->user->can('Secretario'), 'items'   => [
                        ['label' => 'Anteproyecto', 'url' => ['/anteproyecto/reportante'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Proyecto', 'url' => ['/proyecto/reportpro'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Directores de proyectos', 'url' => ['/director-proyecto-por-proyecto/reportdir'], 'visible' => Yii::$app->user->can('Secretario')],
                    ],
                ],
                ['label'   => 'Administrar', 'options' => ['class' => 'treeview-menu'], 'visible' => Yii::$app->user->can('Secretario'), 'items'   => [
                        ['label' => 'Registrar', 'url' => \Yii::$app->urlManagerFrontEnd->baseUrl . '/index.php?r=site%2Fsignup', 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Crear Jurado', 'url' => ['/jurado/index'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Crear director', 'url' => ['/director-proyecto/index'], 'visible' => Yii::$app->user->can('Secretario')],
                    ],
                ],
                ['label'   => 'Administrar', 'options' => ['class' => 'treeview-menu'], 'visible' => Yii::$app->user->can('Estudiante'), 'items'   => [
                        ['label' => 'Cambiar Contraseña', 'url' => ['/user/cambiar_password'], 'visible' => Yii::$app->user->can('Estudiante')],
                    ]],
            ];
            if (Yii::$app->user->isGuest)
            {
                $menuItems[] = ['label' => 'Iniciar sesión', 'url' => ['/site/login']];
            }
            else
            {
                $menuItems[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items'   => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
        <script>
            $(function ()
            {
                ocultar_sta();
            });
            function ocultar_sta()
            {
                ocultar = <?php
                $id = Yii::$app->user->id;
                if (!is_null($id))
                {
                    $script       = "SELECT
          `revision`.`estado`
        FROM
          `revision`
          INNER JOIN `anteproyecto` ON (`revision`.`idanteproyecto` = `anteproyecto`.`idanteproyecto`)
          WHERE `anteproyecto`.`id`=" . $id;
                    //echo $script;exit;
                    $sql          = Yii::$app->db->createCommand($script);
                    $dataProvider = new ArrayDataProvider([
                        'allModels' => $sql->queryAll(),
                    ]);
                    for ($i = 0; $i < count($dataProvider->allModels); $i++)
                    {
                        $estado = $dataProvider->allModels[$i]['estado'] == 'Aceptado';
                    }

                    // var_dump($dataProvider->allModels[$i]['estado']);
                    //var_dump(count($dataProvider->allModels));exit;
                    if (count($dataProvider->allModels) > 0 && @($estado))
                    {
                        echo 'false'; //no queremos ocultarlo
                    }
                    else
                    {
                        echo 'true';
                    }
                }
                else
                {
                    echo 'true';
                }
                ?>;
                if (ocultar)
                {
                    $('.estado_proyecto').hide();

                }
                else {
                    $('.estado_proyecto').show();
                    //$('.estado_anteproyecto').hide();

                }
            }
        </script>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
