<?php $contador=count($model); if ($model !== null):?>
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
 table thead td { background-color: #0061a2;
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
 border: 0.1mm solid #000000;     C5FF40
 }
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
<table width="100%"><tr>
<td width="50%" style="color:#0061a2" ><span style="font-weight: bold; font-size: 14pt;">Anteproyectos</span><br />Calle 5 No. 3-85 Popayán<br />Colombia Código ICFES 2849<br/><span style="font-size: 15pt;">&#9742;</span> PBX: 8213000 - Fax: 8214000</td>
<td width="50%" style="text-align: center;"><b><center></center></b></td>
<img style="float: right;" src="image/uniau.jpg" alt="Imagen fundacion"   WIDTH=100   >
</tr></table>
</htmlpageheader>

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Página {PAGENO} de {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->
 <br />
 <br /><br /><br /><br />
<div style="text-align: right"><b>Fecha: </b><?php echo date("d/m/Y"); ?> </div>
<b>Total Resultados:</b> <?php echo $contador; ?>
 <table border="1" class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="5">
 <thead>
 <tr>
<td width="20%", color="white">Estudiante</td>
 <td width="20%", color="white">Anteproyecto</td>
 <td width="40%", color="white">Modalidad</td>
 <td width="20%", color="white">Fecha de creación</td>


 <!--
 <td width="16.666666666667%">Marca</td>
 <td width="16.666666666667%">Descripción</td>
 <td width="16.666666666667%">Unidad de medida</td>
 <td width="16.666666666667%">Precio Compra</td>
 <td width="6.666666666667%">% Dcto</td>
 <td width="6.666666666667%">% IVA</td> -->
 </tr>
 </thead>
 <tbody>
 <!-- ITEMS -->
 <?php foreach($model as $row): ?>
 <tr>
   <td align="center">
   <?php echo $row->Estudiante; ?>
   </td>
   <td align="center">
   <?php echo $row->nombre; ?>
   </td>
   <td align="center">
   <?php echo $row->Modalidad; ?>
   </td>
   <td align="center">
     <!--  Se debe crear un alias en la consulta y Crear un atributo public en el modelo para que lo acceda -->
   <?php echo $row->date_create;  ?>
   </td>
 </tr>
 <?php endforeach; ?>
 <!-- FIN ITEMS -->
 <tr>
 <td class="blanktotal" colspan="5" rowspan="1"></td>
 </tr>
 </tbody>
 </table>
 </body>
 </html>
<?php endif; ?>
