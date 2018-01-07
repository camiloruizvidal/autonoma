<?php

function iniciar($titulo, $descripcion, $fecha_evento)
{
    include_once './conexion.php';
    $sql = "INSERT INTO
            `evento`(`titulo`,`descripcion`,`fecha`)
            VALUES('{$titulo}', '{$descripcion}', '{$fecha_evento}')";
    conexion::dosql($sql);
}

iniciar($_POST['titulo'], $_POST['descripcion'], $_POST['fecha_evento']);
