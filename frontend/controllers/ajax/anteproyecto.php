<?php

function iniciar()
{
    include_once './visual.php';
    include_once './conexion.php';
    $sql  = "SELECT 
  DATE_FORMAT(`anteproyecto`.`date_create`,'%d-%m-%Y') as fecha_creado,
  CONCAT_WS(' ', `user`.`nombre`, `user`.`apellido`) AS `estudiante`,
  `anteproyecto`.`nombre`,
  `modalidad`.`nombre` AS `modalidad`,
  `anteproyecto`.`idanteproyecto`,
  `anteproyecto`.`estado`  
FROM
  `user`
  INNER JOIN `anteproyecto` ON (`user`.`id` = `anteproyecto`.`id`)
  INNER JOIN `modalidad` ON (`anteproyecto`.`idmodalidad` = `modalidad`.`idmodalidad`)
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
                  <li><a href="index.php?r=anteproyecto%2Fdownload&amp;id=1" title="Descargar" data-pjax="0"><img src="image/descarga.png" width="15" alt=""> Descargar</a></li>
                  ';
        if ($temp['estado'] == '0')
        {
            $button .= '<li><a href="index.php?r=anteproyecto%2Fpublic&id=8" title="Publicar" aria-label="Publicar" data-pjax="0" data-confirm="¿Esta seguro que desea publicar este proyecto?" data-method="post"><span class="glyphicon glyphicon-ok"></span> Publicar</a></li>
                  ';
        }
        $button .= '<li><a href="index.php?r=anteproyecto%2Fview&id=7" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-zoom-in"></span> Detalle</a></li>
                </ul>
              </div>';
        $temp['idanteproyecto'] = $button;
        $data[$key]             = $temp;
    }
    $encabezados = array('#', 'Fecha', 'Estudiante', 'Nombre', 'Tipo', 'Opciones');
    $html        = '<table id="table_anteproyecto" class="table table-striped table-bordered">' . "\n";
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
        if ($data[$i]['estado'] == '1')
        {
            $color = ' class="success" ';
        }
        $html.='        <tr' . $color . '>' . "\n";

        $html.='            <td>' . ($i + 1) . '</td>' . "\n";
        foreach ($data[$i] as $key => $temp)
        {
            if ($key != 'estado')
            {
                $html.='            <td>' . $temp . '</td>' . "\n";
            }
        }
        $html.='        </tr>' . "\n";
    }
    $html.='    </tbody>' . "\n";
    $html.='</table>';
    echo $html;
}

iniciar();
