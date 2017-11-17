<?php

class conexion
{

    private function conn()
    {

        $url            = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main-local.php';
        $data           = include($url);
        $dns            = $data["components"]["db"]["dsn"];
        $nombre_usuario = $data["components"]["db"]['username'];
        $pass           = $data["components"]["db"]['password'];
        $opciones       = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $conn           = new PDO($dns, $nombre_usuario, $pass, $opciones);
        return $conn;
    }

    public static function records($sql, $parameters = array())
    {
        $conn = self::conn();
        $Res  = array();
        $data = $conn->query($sql);
        foreach ($data as $row)
        {
            $temp2 = array();
            foreach ($row as $key => $temp)
            {
                if (!is_numeric($key))
                {
                    $temp2[$key] = $temp;
                }
            }
            $Res[] = $temp2;
        }

        return $Res;
    }

    public static function dosql($sql, $parameters = array())
    {
        $conn = self::conn();
        $conn->query($sql);
    }

}
