<?php $contador=count($model); if ($model !== null):?>
<html>
<head>
<style>
 body {font-family: arial;
 font-size: 10pt;
 }
 p { margin: 0pt;
 }
 td { vertical-align: top; }
 .items td {
 border-left: 0.1mm solid #000000;
 border-right: 0.1mm solid #000000;
 }
 table thead td { background-color: #EEEEEE;
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

<!--mpdf
 <htmlpageheader name="myheader">
 <table width="100%"><tr>
 <td width="50%" style="color:#0000BB;"><span style="font-weight: bold; font-size: 14pt;"></span><br />Jurados Existente<br /><span style="font-size: 15pt;">&#9742;</span> 0775-232355</td>
 <td width="50%" style="text-align: right;"><b>Jurados</b></td>
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
<div style="text-align: right"><b>Fecha: </b><?php echo date("d/m/Y"); ?> </div>
<b>Total Resultados:</b> <?php echo $contador; ?>
 <table border="1" class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="5">
 <thead>
 <tr>
 <td width="50%">Id</td>
 <td width="50%">Nombre</td>
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
 <?php echo $row->iddirector_proyecto; ?>
 </td>
 <td align="center">
 <?php echo $row->nombre; ?>
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
