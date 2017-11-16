<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(function()
{
  ocultar_sta();
});
  function ocultar_sta()
  {
    ocultar= <?php

    $id=Yii::$app->user->id;
    if(!is_null($id))
    {
    $script="SELECT
  `revision`.`estado`
FROM
  `revision`
  INNER JOIN `anteproyecto` ON (`revision`.`idanteproyecto` = `anteproyecto`.`idanteproyecto`)
  WHERE `anteproyecto`.`id`=".$id;
  //echo $script;exit;
    $sql = Yii::$app->db->createCommand($script);
    $dataProvider = new ArrayDataProvider([
      'allModels' => $sql->queryAll(),
     ]);
//     $estado=($dataProvider->allModels[0]['estado']);
    // var_dump(count($dataProvider->allModels));exit;
if(count($dataProvider->allModels)>0 &&@($dataProvider->allModels[0]['estado']=='Aprobado'))
{
  echo 'false';//no queremos ocultarlo
}
else{
  echo 'true';
}
}
else {
  echo 'true';
}
     ?>;
    if(ocultar)
    {
      $('.estado_proyecto').hide();
    }
    else {
      $('.estado_proyecto').show();
    }
  }
</script>
