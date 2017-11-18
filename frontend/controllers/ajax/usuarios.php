<?php

function iniciar()
{
    include_once './visual.php';
    include_once './conexion.php';
    $where = '';
    if ($_POST['nombre'] != '')
    {
        $where [] = ' `user`.`nombre` LIKE "%' . $_POST['nombre'] . '%" OR'
                . ' `user`.`apellido` LIKE "%' . $_POST['nombre'] . '%" ';
    }
    if ($_POST['documento'] != '')
    {
        $where [] = ' `user`.`codigo_estudiantil` LIKE "%' . $_POST['documento'] . '%" ';
    }
    if ($_POST['programa'] != '-1')
    {
        $where [] = ' `user`.`facultad`="' . $_POST['programa'] . '" ';
    }
    if ($_POST['estado'] != '-1')
    {
        $where [] = ' `user`.`status`=' . $_POST['estado'] . ' ';
    }
    if ($_POST['rol'] != '-1')
    {
        $where [] = ' `auth_assignment`.`item_name`="' . $_POST['rol'] . '" ';
    }
    if ($where != '')
    {
        $where = ' WHERE ' . implode(' AND ', $where);
    }
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
                ' . $where . '
                ORDER BY 1';
    $Data = conexion::records($sql);
    foreach ($Data as $key => $temp)
    {
        $temp['edit'] = '<a href="' . $temp['edit'] . '" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>';
        $Data[$key]   = $temp;
    }
    echo visual::Tabla($Data, array('#', 'Usuario', 'Documento', 'Programa', 'Estado', 'Rol', 'Editar'), 'table_usuarios');
}

iniciar();
