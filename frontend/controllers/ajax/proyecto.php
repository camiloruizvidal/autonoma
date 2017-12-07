<?php

function iniciar()
{
    include_once './visual.php';
    include_once './conexion.php';
    $where = '';
    if ($_POST['nombre'] != '')
    {
        $where[] = ' (trim(LOWER(`user`.`nombre`)) LIKE \'%' . trim(strtolower($_POST['nombre'])) . '%\' 
                 OR  trim(LOWER(`user`.`apellido`)) LIKE \'%' . trim(strtolower($_POST['nombre'])) . '%\') ';
    }
    if ($_POST['proyecto'] != '')
    {
        $_POST['proyecto'] = trim($_POST['proyecto']);
        $data              = explode(' ', $_POST['proyecto']);
        $where2            = array();
        foreach ($data as $temp)
        {
            $where2[] = $where[]  = ' trim(LOWER(`proyecto`.`nombre`)) LIKE \'%' . trim(strtolower($temp)) . '%\' ';
        }
        $where[] = '(' . implode(' OR ', $where2) . ')';
    }
    if ($_POST['jurado'] != '')
    {
        $_POST['jurado'] = trim($_POST['jurado']);
        $data            = explode(' ', $_POST['jurado']);
        $where2          = array();
        foreach ($data as $temp)
        {
            $where2[] = ' trim(LOWER(`jurado`.`nombre`)) LIKE \'%' . trim(strtolower($temp)) . '%\' OR 
                          trim(LOWER(`jurado1`.`nombre`)) LIKE \'%' . trim(strtolower($temp)) . '%\' OR ';
        }
        $where[] = '(' . implode(' OR ', $where2) . ')';
    }
    if ($_POST['activo'] != '-1')
    {
        $where[] = ' `proyecto`.`estado` = ' . $_POST['activo'] . ' ';
    }
    if ($_POST['inicio'] != '')
    {
        $where[] = ' date(`proyecto`.`date_create`)>= date("' . $_POST['inicio'] . '") ';
    }
    if ($_POST['fin'] != '')
    {
        $where[] = ' date(`proyecto`.`date_create`)<= date("' . $_POST['fin'] . '") ';
    }
    if ($where != '')
    {
        $where = ' where ' . "\n" . implode("\n" . ' and ' . "\n", $where);
    }
    $sql  = "SELECT 
        concat_ws(' ', `user`.`nombre`, `user`.`apellido`) AS `estudiante`,
        `proyecto`.`nombre`,
        `proyecto`.`descripcion`,
        date_format(`proyecto`.`date_create`,'%d-%m-%Y') as fecha,
        (date(now())-date(`user`.`created_at`)) as dias,
        COALESCE(`jurado`.`nombre`, 'No asignado') AS `ju1`,
        COALESCE(`jurado1`.`nombre`, 'No asignado') AS `ju2`,
        `proyecto`.`estado`,
        `proyecto`.`idproyecto` 
FROM
  `proyecto`
  INNER JOIN `user` ON (`proyecto`.`id` = `user`.`id`)
  LEFT OUTER JOIN `jurado_has_proyecto` ON (`proyecto`.`idproyecto` = `jurado_has_proyecto`.`idproyecto`)
  LEFT OUTER JOIN `jurado` ON (`jurado_has_proyecto`.`idjurado` = `jurado`.`idjurado`)
  LEFT OUTER JOIN `jurado` `jurado1` ON (`jurado_has_proyecto`.`idjurado2` = `jurado1`.`idjurado`)
  {$where}
ORDER BY
  1 DESC";
    $data = conexion::records($sql);
    foreach ($data as $key => $temp)
    {
        $button = '<div class="btn-group" role="group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Opciones
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  ';
        if ($temp['estado'] == '1')
        {
            $temp['estado'] = 'SI';
        }
        else
        {
            $temp['estado'] = 'NO';
            $button .= '<li><a href="index.php?r=proyecto%2Fview&id=' . $temp['idproyecto'] . '" title="Publicar" aria-label="Publicar" data-pjax="0" data-confirm="¿Esta seguro que desea publicar este proyecto?" data-method="post"><span class="glyphicon glyphicon-ok"></span> Publicar</a></li>';
        }
        $button .= '<li><a href="index.php?r=proyecto%2Fview&id=' . $temp['idproyecto'] . '" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-zoom-in"></span> Detalle</a></li>
                <li><a href="index.php?r=proyecto%2Fdownload&id=' . $temp['idproyecto'] . '" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-download"></span> Descargar</a></li>
                </ul>
              </div>';
        $temp['idproyecto'] = $button;
        $data[$key]         = $temp;
    }
    $encabezados = array('#', 'Estudiante', 'Titulo', 'Descripción', 'Fecha de creacion','Dias restantes' ,'Jurado<br/>No 1', 'Jurado<br/>No 2', 'Publicado', 'Opciones');
    $html        = '<table id="table_proyecto" class="table table-striped table-bordered">' . "\n";
    $html .= '  <thead>' . "\n";
    $html .= '  <tr>' . "\n";
    foreach ($encabezados as $temp)
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
