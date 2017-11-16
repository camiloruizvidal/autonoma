<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
// $this->registerAssetBundle('app');
?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo Html::encode(\Yii::$app->name); ?> - A ThemeFactory.net Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $this->theme->baseUrl ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo $this->theme->baseUrl ?>/css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style id="tfeditor-style">
            body {
        background-image: url(https://i.imgur.com/2WbXEuE.jpg);
      }

.navbar-default, .box, footer {
background-color: rgba(255,255,255,0.75);
}

.carousel-inner .item {
  max-height: 500px;
}
    </style>

</head>

<body>
<?php $this->beginBody() ?>
    <div class="brand"><?php echo Html::encode(\Yii::$app->name); ?></div>
    <div class="address-bar">Some Inspirational Quote Here | 123.456.7890</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="#"><?php echo Html::encode(\Yii::$app->name); ?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php
      				echo Menu::widget([
      				  'options' => [
      				    "id"  => "nav",
      				    "class" => "nav navbar-nav navbar-fixed-top"
      				  ],
    				    'items' => [

                          ['label' => 'Anteproyectos', 'url' => ['/anteproyecto/vercomite'], 'visible' => Yii::$app->user->can('Comite')],

                          ['label' => 'Jurado', 'options' => ['class' => 'treeview-menu'],'visible' => Yii::$app->user->can('Secretario') , 'items' => [
                            ['label' => 'Ver Jurados', 'url' => ['/jurado/index'], 'visible' => Yii::$app->user->can('Secretario')],
                            ['label' => 'Ver Jurados', 'url' => ['/jurado-has-proyecto/verjurado'], 'visible' => Yii::$app->user->can('Estudiante')],
                            ['label' => 'Asignar Jurados', 'url' => ['/jurado-has-proyecto/index'], 'visible' => Yii::$app->user->can( 'Secretario')],
                            ],
                          ],

                          ['label' => 'Jurado', 'options' => ['class' => 'estado_proyecto treeview-menu'],'visible' => Yii::$app->user->can('Estudiante'), 'items' => [
                            ['label' => 'Ver Jurados', 'url' => ['/jurado-has-proyecto/verjurado'], 'visible' => Yii::$app->user->can('Estudiante')],
                            ],
                          ],
                          ['label' => 'Anteproyecto', 'options' => ['class' => 'treeview-menu'],'visible' => Yii::$app->user->can('Secretario'),  'items' => [
                            ['label' => 'Ver Anteproyectos', 'url' => ['/anteproyecto/index'], 'visible' => Yii::$app->user->can('Secretario')],
                            ['label' => 'asignar Revisiones', 'url' => ['/revision/index'], 'visible' => Yii::$app->user->can( 'Secretario')],
                            ],
                          ],
                          ['label' => 'Anteproyecto', 'options' => ['class' => 'estado_anteproyecto treeview-menu'],'visible' => Yii::$app->user->can('Estudiante'),  'items' => [
                            ['label' => 'Ver Anteproyecto', 'url' => ['/anteproyecto/veranteproyecto'], 'visible' => Yii::$app->user->can('Estudiante')],
                            ],
                          ],
                          ['label' => 'Seguimiento', 'options' => ['class' => 'treeview-menu'],'visible' => Yii::$app->user->can('Estudiante'),  'items' =>
                          [
                          ['label' => 'Anteproyecto', 'url' => ['/revision/seguimiento'], 'visible' => Yii::$app->user->can('Estudiante')],
                          ['label' => 'Proyecto', 'url' => ['/revisionp/seguimiento'], 'visible' => Yii::$app->user->can('Estudiante')],
                            ],
                          ],

                          ['label' => 'Proyecto', 'options' => ['class' => 'treeview-menu'],'visible' => Yii::$app->user->can('Secretario'),  'items' => [
                            ['label' => 'Ver Proyectos', 'url' => ['/proyecto/index'], 'visible' => Yii::$app->user->can('Secretario')],

                            ['label' => 'asignar revisiones', 'url' => ['/revisionp/index'], 'visible' => Yii::$app->user->can( 'Secretario')],
                            ['label' => 'asignar sustentacion', 'url' => ['/sustentacion-final/index'], 'visible' => Yii::$app->user->can( 'Secretario')],
                            ],
                          ],
                          ['label' => 'Proyecto', 'options' => ['class' => 'estado_proyecto treeview-menu'],'visible' => Yii::$app->user->can('Estudiante'),  'items' => [
                            ['label' => 'Ver Proyecto', 'url' => ['/proyecto/verproyecto'], 'visible' => Yii::$app->user->can('Estudiante')],
                            ],
                          ],

                          // asi se estbalece que usuario puede ver que menu 'visible' => Yii::$app->user->can('Estudiante')


                          ['label' => 'Banco de proyectos', 'url' => ['/conocimiento/index'], 'visible' => Yii::$app->user->can('Docente')],
                          ['label' => 'Banco de proyectos', 'url' => ['/conocimiento/ver'],  'access' => Yii::$app->user->can('Estudiante', 'Secretario', 'Comite')],
    				        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
    				    ],
      				]);
	  		    ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12 text-center">
                    <div id="carousel-example-generic" class="carousel slide">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="img-responsive img-full" src="https://i.imgur.com/F3BU8tZ.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="https://i.imgur.com/Csvrkro.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="https://i.imgur.com/4a9kOk6.jpg" alt="">
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                    <h2 class="brand-before">
                        <small>Welcome to</small>
                    </h2>
                    <h1 class="brand-name">My Application</h1>
                    <hr class="tagline-divider">
                    <h2>
                        <small>By
                            <strong>ThemeFactory.net</strong>
                        </small>
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Build a website
                        <strong>worth visiting</strong>
                    </h2>
                    <hr>
                    <img class="img-responsive img-border img-left" src="https://i.imgur.com/QJdONY4.jpg" alt="">
                    <hr class="visible-xs">
                    <p>The boxes used in this template are nested inbetween a normal Bootstrap row and the start of your column layout. The boxes will be full-width boxes, so if you want to make them smaller then you will need to customize.</p>
                    <p>A huge thanks to <a href="http://join.deathtothestockphoto.com/" target="_blank">Death to the Stock Photo</a> for allowing us to use the beautiful photos that make this template really come to life. When using this template, make sure your photos are decent. Also make sure that the file size on your photos is kept to a minumum to keep load times to a minimum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; <?php echo Html::encode(\Yii::$app->name); ?> 2016</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?php echo $this->theme->baseUrl ?>/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $this->theme->baseUrl ?>/js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
      interval: 5000
    });
    </script>
    <?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
