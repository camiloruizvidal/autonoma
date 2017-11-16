<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Nav;
use common\widgets\Alert;
use backend\assets\AppAsset;
use yii\bootstrap\NavBar;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
// $this->registerAssetBundle('app');
AppAsset::register($this);
?>

<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="en">

<head>


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
        background-image: url("image/au.jpeg");
      }

.brand, .address-bar{
   background-color: rgba(0,0,0,0.5);
}

    </style>
    <title><?= Html::encode($this->title) ?></title>
      <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
    <div class="brand"><?php echo Html::encode(\Yii::$app->name); ?></div>
    <div class="address-bar">Somos Autonomos</div>

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
              NavBar::begin([

              ]);
              $menuItems = [
                  ['label' => 'Home', 'url' => ['/site/index']],
                  ['label' => 'Jurado', 'options' => ['class' => 'treeview-menu'], 'items' => [
                    ['label' => 'Ver Jurados', 'url' => ['/jurado/index'], 'visible' => Yii::$app->user->can('Secretario')],
                    ['label' => 'Asignar Jurados action', 'url' => ['/jurado-has-proyecto/index'], 'visible' => Yii::$app->user->can( 'Secretario')],
                    ],
                  ],
                  //['label' => 'Jurado', 'url' => ['/jurado/index'], 'visible' => Yii::$app->user->can('Secretario')],
                  ['label' => 'Sustentacion', 'url' => ['/sustentacion-final/index'], 'visible' => Yii::$app->user->can('Secretario')],
                  ['label' => 'Anteproyecto', 'url' => ['/anteproyecto/index'], 'visible' => Yii::$app->user->can('Secretario')],
                  ['label' => 'Anteproyecto', 'url' => ['/anteproyecto/veranteproyecto'], 'visible' => Yii::$app->user->can('Estudiante')],
                  // asi se estbalece que usuario puede ver que menu 'visible' => Yii::$app->user->can('Estudiante')
                  ['label' => 'Proyecto', 'url' => ['/proyecto/index'], 'visible' => Yii::$app->user->can( 'Secretario')],
                  ['label' => 'Asignae jurado', 'url' => ['/jurado-has-proyecto/index'], 'visible' => Yii::$app->user->can( 'Secretario')],
                  ['label' => 'Proyecto', 'url' => ['/proyecto/verproyecto'], 'visible' => Yii::$app->user->can('Estudiante')],
                  ['label' => 'Conocimiento', 'url' => ['/conocimiento/index']],

              ];
              if (Yii::$app->user->isGuest) {
                  $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
              } else {
                  $menuItems[] = '<li>'
                      . Html::beginForm(['/site/logout'], 'post')
                      . Html::submitButton(
                          'Logout (' . Yii::$app->user->identity->username . ')',
                          ['class' => 'btn navbar-nav navbar-left ']
                      )
                      . Html::endForm()
                      . '</li>';
              }
              echo Nav::widget([
                  'options' => ['class' => 'navbar-nav navbar-left'],
                  'items' => $menuItems,
              ]);
              NavBar::end();
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
                                <img class="img-responsive img-full" src="https://i.imgur.com/XAOnnJK.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="http://i.imgur.com/5eGXvu6.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="https://i.imgur.com/7KT8ny3.jpg" alt="">
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