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
    $temp['iddocumento'] = '
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Opciones
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="./index.php?r=documento%2Fdownload&amp;id=' . $temp['iddocumento'] . '" title="Descargar" data-pjax="0"><img src="image/descarga.png" width="15" alt=""> Descargar</a></li>
                  <li><a href="/autonoma/frontend/web/index.php?r=documento%2Fupdate&amp;id=' . $temp['iddocumento'] . '" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span> Editar</a></li>
                  <li><a href="/autonoma/frontend/web/index.php?r=documento%2Fdelete&amp;id=' . $temp['iddocumento'] . '" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span> Eliminar</a></li>
                </ul>
              </div>';
    $Data[$key]          = $temp;
}
echo visual::Tabla($Data, array('#', 'Proyectos', 'Opciones'), 'table_documentos');
