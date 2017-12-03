<?php

include_once './visual.php';
include_once './conexion.php';

function valida($data)
{
    $sql  = 'SELECT 
                CONCAT_WS(\'  \',`user`.`nombre`, `user`.`apellido`) as user,
                `user`.`codigo_estudiantil`,
                `user`.`facultad`,
                `user`.`status`,
                `auth_assignment`.`item_name`,
                CONCAT(\'index.php?r=user%2Fupdate&id=\',`user`.`id`) as edit
            FROM
                `auth_assignment`
                INNER JOIN `user` ON (`auth_assignment`.`user_id` = `user`.`id`)
                
                ORDER BY 1';
    $Data = conexion::records($sql);
}

if (valida($_POST["SignupForm"]))
{
    
}