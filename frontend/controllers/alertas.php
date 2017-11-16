<?php

function conn()
{
	$url='..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'main-local.php';
	$data=include($url);
	$dns = $data["components"]["db"]["dsn"];
	$nombre_usuario = $data["components"]["db"]['username'];
	$pass = $data["components"]["db"]['password'];
	$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
	$conn = new PDO($dns, $nombre_usuario, $pass, $opciones);	
	return $conn;
}
function anteproyecto()
{
	$conn=conn();
	$sql = 'SELECT 
	  sum(`anteproyecto`.`alerta`) as alerta
	FROM
	  `anteproyecto`';
	$Res=0;
	foreach ($conn->query($sql) as $row) 
	{
		$Res=(int)($row['alerta'] );
		
	}
	return $Res;
}
function proyecto()
{
	$conn=conn();
	$sql = 'SELECT 
  SUM(`proyecto`.`idproyecto`) AS `alerta`
FROM
  `proyecto`';
	$Res=0;
	foreach ($conn->query($sql) as $row) 
	{
		$Res=(int)($row['alerta'] );
		
	}
	return $Res;
}
echo json_encode(array('Anteproyecto'=>anteproyecto(),'Proyecto'=>proyecto()));
?>