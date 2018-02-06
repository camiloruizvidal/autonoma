<?php

include_once './conexion.php';
$sql = 'UPDATE
  `anteproyecto`
SET
  `estado` = 1,
  `radicado` = "' . $_POST['radicado'] . '"
  WHERE
  `anteproyecto`.`idanteproyecto`=' . $_POST['id_publicar'];
conexion::records($sql);
