<?php
date_default_timezone_set('America/Bogota');
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
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
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>Sistema de gestion</title>
        <?php $this->head() ?>
        <script src="js/jquery/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.dataTables.min.js" type="text/javascript" charset="utf8" ></script>
        <script src="js/toastr.min.js"></script>
        <link href="css/toastr.min.css" rel="stylesheet">
        <link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css"/>
    </head>
    <body>
        <style>body{margin-top: 70px;}</style>
        <?php $this->beginBody() ?>       

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Html::img('imagen/logo.png', ['alt' => 'some', 'width' => '90']),
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
                    ],
                ],
                ['label'   => 'Anteproyecto', 'options' => ['class' => 'treeview-menu'], 'visible' => Yii::$app->user->can('Comite'), 'items'   => [
                        ['label' => 'Anteproyectos', 'url' => ['/anteproyecto/index'], 'visible' => Yii::$app->user->can('Comite')],
                        ['label' => 'Asignar Concepto', 'url' => ['/revision/index'], 'visible' => Yii::$app->user->can('Comite')],
                    ],
                ],
                ['label'   => 'Anteproyecto', 'options' => ['class' => 'estado_anteproyecto treeview-menu'], 'visible' => Yii::$app->user->can('Estudiante'), 'items'   => [
                        ['label' => 'Crear Anteproyecto', 'url' => ['/anteproyecto/index'], 'visible' => Yii::$app->user->can('Estudiante')],
                        ['label' => 'Seguimiento', 'url' => ['/revision/index'], 'visible' => Yii::$app->user->can('Estudiante')],
                    ],
                ],
                ['label'   => 'Proyecto', 'options' => ['class' => 'treeview-menu'], 'visible' => Yii::$app->user->can('Jurado'), 'items'   => [
                        ['label' => 'Ver Proyecto', 'url' => ['/proyecto/index'], 'visible' => Yii::$app->user->can('Jurado')],
                        ['label' => 'Asignar Concepto', 'url' => ['/revisionp/index'], 'visible' => Yii::$app->user->can('Jurado')],
                    ],
                ],
                ['label'   => 'Proyecto', 'options' => ['class' => 'treeview-menu'], 'visible' => Yii::$app->user->can('Secretario'), 'items'   => [


                        ['label' => 'Ver Proyectos', 'url' => ['/proyecto/index'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Asignar director', 'url' => ['/director-proyecto-por-proyecto/index'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Asignar Sustentación', 'url' => ['/sustentacion-final/index'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Asignar Jurados', 'url' => ['/jurado-has-proyecto/index'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Novedades', 'url' => ['/novedades/index'], 'visible' => Yii::$app->user->can('Secretario')],
                    //Estudiante
                    ],],
                ['label'   => 'Proyecto', 'options' => ['class' => 'estado_proyecto treeview-menu'], 'visible' => Yii::$app->user->can('Estudiante'), 'items'   => [
                        ['label' => 'Crear Proyecto', 'url' => ['/proyecto/index'], 'visible' => Yii::$app->user->can('Estudiante')],
                        ['label' => 'Seguimiento', 'url' => ['/revisionp/index'], 'visible' => Yii::$app->user->can('Estudiante')],
                        ['label' => 'Sustentación', 'url' => ['/sustentacion-final/index'], 'visible' => Yii::$app->user->can('Estudiante')],
                        ['label' => 'Novedades', 'url' => ['/novedades/index'], 'visible' => Yii::$app->user->can('Estudiante')],
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
                        ['label' => 'Estudiante', 'url' => ['/user/reportestu'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Anteproyecto', 'url' => ['/anteproyecto/reportante'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Proyecto', 'url' => ['/proyecto/reportpro'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Directores de proyectos', 'url' => ['/director-proyecto-por-proyecto/reportdir'], 'visible' => Yii::$app->user->can('Secretario')],
                    ],
                ],
                ['label'   => 'Administrar', 'options' => ['class' => 'treeview-menu'], 'visible' => !Yii::$app->user->isGuest, 'items'   => [
                        ['label' => 'Gestionar Usuarios', 'url' => ['/user/index'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Cambiar Contraseña', 'url' => ['/site/change-password']],
                        //['label' => 'Registrar', 'url' => ['/site/signup'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Crear Jurado', 'url' => ['/jurado/index'], 'visible' => Yii::$app->user->can('Secretario')],
                        ['label' => 'Crear director', 'url' => ['/director-proyecto/index'], 'visible' => Yii::$app->user->can('Secretario')],
                    ],
                ],
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
                                'Cerrar Sesión (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
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
            <?php
            if (is_null(Yii::$app->user->getId()))
            {
                ?>
                <?php
                }
                if (Yii::$app->user->can('Estudiante'))
                {
                $Fechafin = Yii::$app->user->identity["fecha_fin"];
                $FechaActual = date('Y-m-d');
                $datetime1 = new DateTime($Fechafin);
                $datetime2 = new DateTime($FechaActual);
                $interval = $datetime2->diff($datetime1);
                if ($datetime1 <= $datetime2)
                {
                echo '<div class = "alert alert-danger" role = "alert">
                        <span class = "glyphicon glyphicon-exclamation-sign" aria-hidden = "true"></span>
                        <span class = "sr-only">Error:</span>
                        Su tiempo para realizar su trabajo de grado termino. Su plazo máximo era para el dia ' . $Fechafin . '
                        </div>
                        <style>#btn_regresar,.container-fluid{display:none;}</style>';
//                    exit;
                }
                }
                ?>

                <div class="container-fluid">
                    <div class="col-md-12">

                        <button id="btn_regresar" style="margin-bottom: 10px;" onclick="history.back()" class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</button>
                    </div>
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <?= Alert::widget() ?>

                    <?php
                    if (Yii::$app->user->can('Secretario'))
                    {
                        ?>
                        <div class="col-md-3">
                            <script>
                                function ver()
                                {
                                    $.ajax({
                                        url: '../controllers/ajax/toggle_people.php',
                                        success: function (data)
                                        {
                                            $('#data_estudents').html(data);
                                        }
                                    });
                                }
                                $(function ()
                                {
                                    ver();
                                });
                            </script>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Estudiantes
                                </div>
                                <div class="panel-body">
                                    <div id="notification-toggle-2">
                                        <div id="data_estudents">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if (Yii::$app->user->can('Secretario'))
                    {
                        ?>
                        <div class="col-md-9">
                            <?= $content ?>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="col-md-12">
                                <?= $content ?>
                                <?php
                            }
                            ?>
                        </div>

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
    <?php $this->endBody() ?>
        </body>
    </html>
    <?php $this->endPage() ?>
