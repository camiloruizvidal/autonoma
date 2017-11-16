<?php

/* @var $this yii\web\View */

$this->title = 'SGTG';
?>
<div class="site-index"><br>
<h3> 
  <b>
  <?php if (!Yii::$app->user->isGuest && Yii::$app->user->can('Estudiante')) {
    echo 'Restan '.$restante. '  Días';
  } ?>
    
  </b>
</h3>

    <div class="jumbotron">
        <h2>Sistema de Gestión de Trabajos de Grado</h2>
         <img src="imagen/plataforma.png" >
         <img src="imagen/autonoma.png" >
       
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2 align="center">Misión</h2>

                <p align="justify">Educamos con calidad académica para formar líderes con espíritu emprendedor, que a través de la innovación, el pensamiento crítico, la sensibilidad social y la investigación, transformen de manera positiva su entorno.
                </p>

            </div>
            <div class="col-lg-6">
               <h2 align="center">Visión</h2>

                <p align="justify">La Corporación Universitaria Autónoma del Cauca será en el año 2020 una Universidad reconocida en la Región Pacífico de Colombia por su liderazgo en la formación de talento humano de altas calidades profesionales, morales y cívicas, comprometido con la valoración, la preservación y la defensa de sus ingentes recursos ambientales.
                Para lograr este objetivo, la Institución orientará su propuesta académica de investigación, innovación, emprendimiento y extensión primordialmente hacia el desarrollo integral y sustentable de su entorno socioeconómico.</p>
            </div>
            
        </div>

    </div>
</div>
