<?php

function iniciar()
{
    include_once './visual.php';
    include_once './conexion.php';
    $sql  = 'SELECT 
  `conocimiento`.`nombre`,
  `conocimiento`.`descripcion`,
  `conocimiento`.`telefono`,
  `conocimiento`.`correo`,
  `programas`.`descripcion` as programa
FROM
  `conocimiento`
  INNER JOIN `programas` ON (`conocimiento`.`id_programas` = `programas`.`id_programas`)
ORDER BY
`programas`.`descripcion`';
    $Data = conexion::records($sql);
    echo visual::Tabla($Data, array('#', 'Titulo', 'Descripcion', 'Telefono', 'Correo', 'Programa'), 'table_documentos');
}

iniciar();
