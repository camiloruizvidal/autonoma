<?php

include_once './visual.php';
include_once './conexion.php';
$where = "";
if ($_POST['nombre'] != '')
{

    $_POST['nombre'] = trim($_POST['nombre']);
    $var             = explode(' ', $_POST['nombre']);
    foreach ($var as $temp)
    {
        $temp    = htmlspecialchars($temp);
        $where[] = ' UPPER(trim(`documento`.`nombre`)) LIKE "%' . strtoupper(trim($temp)) . '%" ';
    }
}
if ($where != '')
{
    $where = ' WHERE ' . implode(' AND ', $where);
}
$sql  = 'SELECT 
  `documento`.`nombre`,
  COALESCE(`documento_tipo`.`descripcion`,"NN") as descripcion,
  `documento`.`iddocumento`
FROM
  `documento`
  LEFT OUTER JOIN `documento_tipo` ON (`documento`.`id_documento_tipo` = `documento_tipo`.`id_documento_tipo`)
  ' . $where . '
ORDER BY
  `documento`.`nombre`
  ';
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
echo visual::Tabla($Data, array('#', 'Proyectos', 'Tipo', 'Opciones'), 'table_documentos');
