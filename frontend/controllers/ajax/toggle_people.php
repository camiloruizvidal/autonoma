<?php

include_once './conexion.php';

function class_color($dias)
{
    $colors = conexion::records('SELECT `tbl_config`.`value` FROM `tbl_config` WHERE `tbl_config`.`name` = \'alertas\'');
    $colors = json_decode($colors[0]['value'], true);
    $estado = '';
    foreach ($colors as $color => $temp)
    {
        if ($dias >= $temp['inicio'] && $dias <= $temp['fin'])
        {
            $estado = $color;
        }
    }
    return $estado;
}

function data()
{
    $sql  = "SELECT 
  `user`.`id` as id,
  UPPER(CONCAT_WS(' ', `user`.`nombre`, `user`.`apellido`)) AS `user`,
  `user`.`facultad`,
  `user`.`fecha_fin`,
  `user`.`created_at` as fecha_inicio,
  DATEDIFF(date(`user`.`fecha_fin`), date(now())) AS `dias`
FROM
  `proyecto`
  INNER JOIN `user` ON (`proyecto`.`id` = `user`.`id`)
WHERE
  `proyecto`.`id` IN (SELECT `anteproyecto`.`id` FROM `anteproyecto`) AND 
  `proyecto`.`idproyecto` NOT IN (SELECT `sustentacion_final`.`idproyecto` FROM `sustentacion_final`)
GROUP BY
  user.id
ORDER BY
  4";
    $data = conexion::records($sql);
    return $data;
}

$data = data();
$html = '<style>
    .rojo{background-color:red;color:#FFF;}
    .naranja{background-color:orange;color:#FFF;}
    .verde{background-color:green;color:#FFF;}
        </style>';
$html.= '<table class="table">';
$html.= '<tr><td>Estudiante</td><td>Días</td><td>Inicio</td><td>Fin</td><td>Prorroga</td></tr>';

foreach ($data as $temp)
{
    $button = '<center>---</center>';
    $dias   = $temp['dias'];
    if ($temp['dias'] <= 0)
    {
        $button = '<button  data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="editar(' . $temp['id'] . ',\'' . $temp['user'] . '\')"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Opciones</button>';
        $dias   = 'Venció hace ' . (-1 * $dias) . ' dias';
    }
    $html.='<tr class="' . class_color($temp['dias']) . '">';
    $html.='<td>' . $temp['user'] . '</td>';
    $html.='<td>' .$dias.'</td>';
    $html.='<td>' . $temp['fecha_inicio'] . '</td>';
    $html.='<td>' . $temp['fecha_fin'] . '</td>';
    $html.='<td>' . $button . '</td>';
    $html.='</tr>';
}
$html.='</table>';
echo $html;
