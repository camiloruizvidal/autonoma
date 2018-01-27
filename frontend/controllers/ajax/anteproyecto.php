<?php

function iniciar()
{
    include_once './visual.php';
    include_once './conexion.php';
    $where = '';
    if (!isset($_POST['id_estudiante']))
    {
        if ($_POST['nombre'] != '')
        {
            $where[] = ' (trim(LOWER(`user`.`nombre`)) LIKE \'%' . trim(strtolower($_POST['nombre'])) . '%\' 
                 OR  trim(LOWER(`user`.`apellido`)) LIKE \'%' . trim(strtolower($_POST['nombre'])) . '%\') ';
        }
        if ($_POST['proyecto'] != '')
        {
            $where[] = ' trim(LOWER(`anteproyecto`.`nombre`)) LIKE \'%' . trim(strtolower($_POST['proyecto'])) . '%\' ';
        }
        if ($_POST['idmodalidad'] != '-1')
        {
            $where[] = ' `anteproyecto`.`idmodalidad` = ' . $_POST['idmodalidad'] . ' ';
        }
        if ($_POST['activo'] != '-1')
        {
            $where[] = ' `anteproyecto`.`estado` = ' . $_POST['activo'] . ' ';
        }
        if ($_POST['inicio'] != '')
        {
            $where[] = ' date(`anteproyecto`.`date_create`)>= date("' . $_POST['inicio'] . '") ';
        }
        if ($_POST['fin'] != '')
        {
            $where[] = ' date(`anteproyecto`.`date_create`)<= date("' . $_POST['fin'] . '") ';
        }
    }
    else
    {
        $where[] = ' `anteproyecto`.`id` = ' . $_POST['id_estudiante'] . ' ';
    }
    if ($where != '')
    {
        $where = ' where ' . "\n" . implode("\n" . ' and ' . "\n", $where);
    }
    $sql  = "SELECT 
  DATE_FORMAT(`anteproyecto`.`date_create`,'%d-%m-%Y') as fecha_creado,
  CONCAT_WS(' ', `user`.`nombre`, `user`.`apellido`) AS `estudiante`,
  `anteproyecto`.`nombre`,
  `anteproyecto`.`estado`,
  `modalidad`.`nombre` AS `modalidad`,
  COALESCE(`revision`.`estado`, 'No ha sido revisado') AS `estado_revision`,
  COALESCE(`revision`.`num_revisiones`,0) as num_revisiones,
  `anteproyecto`.`idanteproyecto`
FROM
  `user`
  INNER JOIN `anteproyecto` ON (`user`.`id` = `anteproyecto`.`id`)
  INNER JOIN `modalidad` ON (`anteproyecto`.`idmodalidad` = `modalidad`.`idmodalidad`)
  LEFT OUTER JOIN `revision` ON (`anteproyecto`.`idanteproyecto` = `revision`.`idanteproyecto`)
  {$where}
ORDER BY
`anteproyecto`.`estado`, 1 DESC";
    $data = conexion::records($sql);
    $cant = conexion::records('');
    foreach ($data as $key => $temp)
    {
        $button = '<div class="btn-group" role="group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Opciones
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">';

        $button .= '<li><a href="index.php?r=anteproyecto%2Fdownload&amp;id=' . $temp['idanteproyecto'] . '" title="Descargar" data-pjax="0"><img src="image/descarga.png" width="15" alt=""> Descargar</a></li>';
        if ($temp['estado'] == '0')
        {
            $temp['estado'] = 'NO';
            if (!isset($_POST['id_estudiante']))
            {
                $button .= '<li><a href="index.php?r=anteproyecto%2Fpublic&id=' . $temp['idanteproyecto'] . '" title="Publicar" aria-label="Publicar" data-pjax="0" data-confirm="¿Esta seguro que desea publicar este proyecto?" data-method="post"><span class="glyphicon glyphicon-ok"></span> Publicar</a></li>
                  ';
            }
        }
        else
        {
            $temp['estado'] = 'SI';
        }
        $button .= '<li><a href="index.php?r=anteproyecto%2Fview&id=' . $temp['idanteproyecto'] . '" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-zoom-in"></span> Detalle</a></li>
                </ul>
              </div>';
        $temp['idanteproyecto'] = $button;
        $data[$key]             = $temp;
    }
    $encabezados = array('#', 'Fecha', 'Estudiante', 'Nombre', 'Publicado', 'Tipo','Estado revision','No Revisiones','Opciones');
    $html        = '<table id="table_anteproyecto" class="table table-striped table-bordered">' . "\n";
    $html .= '  <thead>' . "\n";
    $html .= '  <tr>' . "\n";
    foreach ($encabezados as $key => $temp)
    {

        $html.='        <th>' . $temp . '</th>' . "\n";
    }
    $html.='    </tr>' . "\n";
    $html.='    </thead>' . "\n";
    $html.='    <tbody>' . "\n";
    for ($i = 0; $i < count($data); $i++)
    {
        $color = ' class="danger" ';
        if ($data[$i]['estado'] == 'SI')
        {
            $color = ' class="success" ';
        }
        $html.='        <tr' . $color . '>' . "\n";

        $html.='            <td>' . ($i + 1) . '</td>' . "\n";
        foreach ($data[$i] as $key => $temp)
        {
            $html.='            <td>' . $temp . '</td>' . "\n";
        }
        $html.='        </tr>' . "\n";
    }
    $html.='    </tbody>' . "\n";
    $html.='</table>';
    echo $html;
}

iniciar();
