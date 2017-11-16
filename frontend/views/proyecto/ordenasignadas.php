<?php
/* @var $this ServicioController */
/* @var $model Servicio */


$this->breadcrumbs=array(
    'Home'=>array('Site/index'),
    'Tecnicos'=>array('Tecnico/index'),
    
);


?>
<h1>Ordenes Asignadas a:  <?php echo $model->Nombre.' '.$model->Apellido; ?> </h1>


<?php $contador=count($rows); 

if ($rows !== null): ?>

<html>
<head>
<style>
 body {font-family: sans-serif;
 font-size: 10pt;
 }
 p { margin: 0pt;
 }
 td { vertical-align: top; }
 .items td {
 border-left: 0.1mm solid #000000;
 border-right: 0.1mm solid #000000;
 }
 table thead td { background-color: #DCDCDC;
 text-align: center;
 border: 0.1mm solid #000000;
 }
 .items td.blanktotal {
 background-color: #FFFFFF;
 border: 0mm none #000000;
 border-top: 0.1mm solid #000000;
 }
 .items td.totals {
 text-align: right;
 border: 0.1mm solid #000000;
 }
</style>
</head>
<body>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="5">
 <thead>
 <tr>
 <td width="10.666666666667%">No Orden</td>
 <td width="14.666666666667%">Ticket</td>
 <td width="10.666666666667%">Estado</td>
 <td width="10.666666666667%">Fecha Asignada</td>
 </tr>
 </thead>
 <tbody>
 <?php $i=0;       
 while($i<$contador){ ?>
 <tr>
 <td align="center"><?php echo $rows[$i]["NoOrden"]; ?></td>
 <td align="center"><?php echo $rows[$i]["Ticket"]; ?></td>
 <td align="center"><?php echo $rows[$i]["Estado"]; ?></td>
 <td align="center"><?php echo $rows[$i]["FechaAsignada"]; ?></td>
 
 </tr> <?php  $i++;  } ?>

 </tbody>
 </table>


 </body>
 </html>


<?php endif;  ?>

<?php /* foreach($rows as $key): */?>
<?php /* $this->widget('zii.widgets.CDetailView', array(
	'data'=>$key,
	'attributes'=>array(
		'Nombre',
		'Apellido',
		'CantidadOrdenes',
	),
)); */ ?>
<?php /* endforeach */ ?>



