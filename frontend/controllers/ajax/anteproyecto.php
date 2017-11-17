<?php

function iniciar()
{
    include_once './visual.php';
    include_once './conexion.php';
    $sql  = "SELECT 
date(`anteproyecto`.`date_create`) as fecha_creado,
  CONCAT_WS(' ', `user`.`nombre`, `user`.`apellido`) AS `estudiante`,
  `anteproyecto`.`nombre`,
  `anteproyecto`.`descripcion`,
  `modalidad`.`nombre` AS `modalidad`,
  `anteproyecto`.`idanteproyecto`,
   case
  WHEN
  `anteproyecto`.`estado`=1
  then
  'SI'
  WHEN
  `anteproyecto`.`estado`=0
  then
  'NO'
  END as publicado
FROM
  `user`
  INNER JOIN `anteproyecto` ON (`user`.`id` = `anteproyecto`.`id`)
  INNER JOIN `modalidad` ON (`anteproyecto`.`idmodalidad` = `modalidad`.`idmodalidad`)
ORDER BY
  1 DESC, 7 ASC";
    $Data = conexion::records($sql);
    echo visual::Tabla($Data, array('#', 'Titulo', 'Descripcion', 'Telefono', 'Correo', 'Programa'), 'table_documentos');
}

iniciar();
