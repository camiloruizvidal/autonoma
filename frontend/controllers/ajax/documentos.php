<?php

include_once './visual.php';
include_once './conexion.php';
$sql  = 'SELECT 
  `documento`.`nombre`,
  `documento`.`iddocumento`
FROM
  `documento`';
$Data = conexion::records($sql);
foreach ($Data as $key => $temp)
{
    $temp['iddocumento'] = '<a href="./index.php?r=documento%2Fdownload&amp;id=' . $temp['iddocumento'] . '" title="Descargar" data-pjax="0"><img src="image/descarga.png" width="15" alt=""></a>, <a href="/autonoma/frontend/web/index.php?r=documento%2Fupdate&amp;id=' . $temp['iddocumento'] . '" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>, <a href="/autonoma/frontend/web/index.php?r=documento%2Fdelete&amp;id=' . $temp['iddocumento'] . '" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>';
    $Data[$key]          = $temp;
}
echo visual::Tabla($Data,array('#','Proyectos','Opciones'),'table_documentos');
