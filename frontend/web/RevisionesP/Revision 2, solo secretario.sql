

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_beneficiario_monitor`  AS  select `g`.`id_creador` AS `id_metodologo`,`gi`.`id_monitor` AS `id_monitor`,`em`.`documento` AS `documento_monitor`,concat(`em`.`apellidos`,' ',`em`.`nombres`) AS `nombre_monitor`,`d`.`nombre` AS `disciplina`,`l`.`nombre` AS `territorio`,`ba`.`nombre` AS `barrio`,`e`.`nombre` AS `escenario`,`eq`.`nombre` AS `equipamento`,`b`.`id` AS `id_benef`,`b`.`documento` AS `documento_beneficiario`,concat(`b`.`apellidos`,' ',`b`.`nombres`) AS `nombre_beneficiario`,`g`.`nombre` AS `grupo`,`gi`.`dia` AS `dia` from ((((((((`beneficiario` `b` join `h_grupo_integrante` `gi`) join `h_grupo` `g`) join `disciplina` `d`) join `esc_equipamento` `eq`) join `escenario` `e`) join `barrio` `ba`) join `localidad` `l`) join `empleado` `em`) where ((`b`.`id` = `gi`.`id_estudiante`) and (`g`.`id` = `gi`.`id_grupo`) and (`g`.`id_disciplina` = `d`.`id`) and (`eq`.`id` = `g`.`id_equipamento`) and (`e`.`id` = `eq`.`id_escenario`) and (`ba`.`id` = `e`.`id_barrio`) and (`l`.`id` = `ba`.`id_localidad`) and (`em`.`id` = `gi`.`id_monitor`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_asistencias_full`
--
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_asistencias_full`  AS  select `r`.`fecha_clase` AS `fecha_clase`,`r`.`dia` AS `dia`,`r`.`asistio` AS `asistio`,`c`.`id_grupo` AS `id_grupo`,`c`.`id_monitor` AS `id_monitor`,`r`.`id_estudiante` AS `id_estudiante` from (`h_asistencias_cabecera` `c` join `h_asistencias_registro` `r`) where (`c`.`id` = `r`.`id_cabecera`) order by `c`.`id_grupo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_beneficiarios_grupos`
--
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_beneficiarios_grupos`  AS  select `b`.`estado` AS `estado_benef`,`g`.`id_creador` AS `id_metodologo`,`l`.`id` AS `id_localidad`,`l`.`nombre` AS `territorio`,`e`.`id` AS `id_monitor`,ucase(concat(`e`.`nombres`,' ',`e`.`apellidos`)) AS `nombre_monitor`,`d`.`id` AS `id_disciplina`,`d`.`nombre` AS `disciplina`,`ba`.`nombre` AS `barrio`,`esc`.`nombre` AS `escenario`,`eq`.`nombre` AS `equipamento`,`b`.`id` AS `id_beneficiario`,`b`.`documento` AS `documento_beneficiario`,ucase(concat(`b`.`nombres`,' ',`b`.`apellidos`)) AS `beneficiario`,`g`.`id` AS `id_grupo`,`g`.`nombre` AS `grupo`,`gi`.`dia` AS `dia` from ((((((((`beneficiario` `b` join `h_grupo_integrante` `gi`) join `h_grupo` `g`) join `empleado` `e`) join `localidad` `l`) join `disciplina` `d`) join `barrio` `ba`) join `escenario` `esc`) join `esc_equipamento` `eq`) where ((`b`.`id` = `gi`.`id_estudiante`) and (`g`.`id` = `gi`.`id_grupo`) and (`e`.`estado` = 3) and (`e`.`id` = `g`.`id_monitor`) and (`g`.`estado` = 1) and (`g`.`id_equipamento` = `eq`.`id`) and (`eq`.`id_escenario` = `esc`.`id`) and (`esc`.`id_barrio` = `ba`.`id`) and (`ba`.`id_localidad` = `l`.`id`) and (`g`.`id_disciplina` = `d`.`id`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_beneficiarios_grupos_beneficiarios`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_beneficiarios_grupos_beneficiarios`  AS  select `l`.`id` AS `id_localidad`,`l`.`nombre` AS `territorio`,`d`.`id` AS `id_disciplina`,`d`.`nombre` AS `disciplina`,`gi`.`id_estudiante` AS `id_estudiante` from ((((((`h_grupo_integrante` `gi` join `h_grupo` `g`) join `localidad` `l`) join `disciplina` `d`) join `barrio` `ba`) join `escenario` `esc`) join `esc_equipamento` `eq`) where ((`g`.`id` = `gi`.`id_grupo`) and (`g`.`id_equipamento` = `eq`.`id`) and (`eq`.`id_escenario` = `esc`.`id`) and (`esc`.`id_barrio` = `ba`.`id`) and (`ba`.`id_localidad` = `l`.`id`) and (`g`.`id_disciplina` = `d`.`id`)) group by `gi`.`id_estudiante` order by `l`.`id`,`g`.`id_disciplina` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_beneficiarios_grupos_monitores`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_beneficiarios_grupos_monitores`  AS  select `l`.`id` AS `id_localidad`,`l`.`nombre` AS `territorio`,`d`.`id` AS `id_disciplina`,`d`.`nombre` AS `disciplina`,`gi`.`id_monitor` AS `id_monitor`,`e`.`presupuesto` AS `presupuesto` from (((((((`h_grupo_integrante` `gi` join `h_grupo` `g`) join `localidad` `l`) join `disciplina` `d`) join `barrio` `ba`) join `escenario` `esc`) join `esc_equipamento` `eq`) join `empleado` `e`) where ((`g`.`id` = `gi`.`id_grupo`) and (`g`.`id_equipamento` = `eq`.`id`) and (`eq`.`id_escenario` = `esc`.`id`) and (`esc`.`id_barrio` = `ba`.`id`) and (`ba`.`id_localidad` = `l`.`id`) and (`g`.`id_disciplina` = `d`.`id`) and (`e`.`id` = `gi`.`id_monitor`)) group by `gi`.`id_monitor`,`e`.`presupuesto` order by `l`.`id`,`g`.`id_disciplina` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_evaluacion_beneficiario`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_evaluacion_beneficiario`  AS  select `ev`.`id_evaluacion` AS `id_evaluacion`,`l`.`id` AS `id_territorio`,`l`.`nombre` AS `territorio`,`d`.`id` AS `id_disciplina`,`d`.`nombre` AS `disciplina`,`g`.`id_monitor` AS `id_monitor`,concat(`em`.`nombres`,' ',`em`.`apellidos`) AS `monitor`,`ev`.`id_grupo` AS `id_grupo`,`g`.`nombre` AS `grupo`,`ev`.`id_beneficiario` AS `id_beneficiario`,concat(`be`.`nombres`,' ',`be`.`apellidos`) AS `beneficiario`,`ind`.`id_tipo` AS `id_tipo`,`it`.`nombre` AS `tipo`,`ind`.`id_categoria` AS `id_categoria`,`ic`.`nombre` AS `categoria`,`ev`.`id_indicador` AS `id_indicador`,`ind`.`nombre` AS `indicador`,`ev`.`nota` AS `nota`,`ev`.`fecha` AS `fecha` from (((((((((((`h_grupo` `g` join `ind_seguimiento` `ev`) join `localidad` `l`) join `esc_equipamento` `eq`) join `escenario` `esc`) join `barrio` `b`) join `disciplina` `d`) join `empleado` `em`) join `ind_indicador_medicion` `ind`) join `ind_categoria` `ic`) join `ind_tipo` `it`) join `beneficiario` `be`) where ((`ev`.`id_grupo` = `g`.`id`) and (`eq`.`id` = `g`.`id_equipamento`) and (`eq`.`id_escenario` = `esc`.`id`) and (`esc`.`id_barrio` = `b`.`id`) and (`l`.`id` = `b`.`id_localidad`) and (`d`.`id` = `g`.`id_disciplina`) and (`em`.`id` = `g`.`id_monitor`) and (`ind`.`id` = `ev`.`id_indicador`) and (`ic`.`id` = `ind`.`id_categoria`) and (`it`.`id` = `ind`.`id_tipo`) and (`be`.`id` = `ev`.`id_beneficiario`)) ;

--
-- Índices para tablas volcadas
--

