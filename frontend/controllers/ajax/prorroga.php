<?php
include_once './conexion.php';
function data($id)
{
    $sql  = "UPDATE
                `user`
              SET
                `fecha_fin` = DATE_ADD(`user`.`fecha_fin`, INTERVAL 6 MONTH)
              WHERE
                `user`.`id`={$id}";
    conexion::dosql($sql);
   
}
data($_POST['id']);