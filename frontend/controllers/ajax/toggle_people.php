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
$html.= '<tr><td>Estudiante</td><td>Días</td><td>Prorroga</td></tr>';

foreach ($data as $temp)
{

    $button = '';
    $dias   = $temp['dias'];
    if ($temp['dias'] <= 0)
    {
        $button = '<button  data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="editar(' . $temp['id'] . ',\'' . $temp['user'] . '\')"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Prorroga</button>';
        $dias   = 'Venció hace ' . (-1 * $dias) . ' dias';
    }
    $html.='<tr class="' . class_color($temp['dias']) . '">';
    $html.='<td>' . $temp['user'] . '</td>';
    $html.='<td>' . $dias . '</td>';
    $html.='<td>' . $button . '</td>';
    $html.='</tr>';
}
$html.='</table>';
$html .= '<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="color: #fff;
    background-color: #337ab7;
    border-color: #2e6da4;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Prorroga</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_prorroga_value" value=""/>
        El estudiante <h1 id="nombre_usuario">Nombre pendiente</h1> se le va a agregar 6 meses de prorroga.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="guardar();">Aceptar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<script>
function guardar()
{
    var id = $("#id_prorroga_value").val()
    $.ajax({
        url: "../controllers/ajax/toggle_people.php",
        success: function (data)
        {
            $("#data_estudents").html(data);
        }
    });                        
}
function editar(id,name)
{
    $("#id_prorroga_value").val(id);
    $("#nombre_usuario").html(name);
}
</script>
';
echo $html;
