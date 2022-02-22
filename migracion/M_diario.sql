INSERT INTO `dbbagsacorp`.`diario` (
  `id`,
  `diario`,
  `anio`,
  `fecha`,
  `tipo`,
  `concepto`,
  `total`,
  `auxiliar`,
  `tipoaux`,
  `iddepartamento`,
  `usuariocreacion`,
  `fechacreacion`,
  `usuarioact`,
  `fechaact`,
  `usuarioan`,
  `fechaan`,
  `usuarioactiva`,
  `fechaactiva`,
  `anticipoctaxp`,
  `anticipoctaxc`,
  `isDeleted`,
  `estatus`
)
SELECT
  NULL,
  `DIARIO`,
  `ANIO`,
  `FECHA`,
  `TIPO`,
  `CONCEPTO`,
  `TOTAL`,
  `AUXILIAR`,
  `TIPO_AUXILIAR`,
  `DEPARTAMENTO`,
  `USUARIO_INGRESA`,
  `FECHA_INGRESA`,
  `USUARIO_ACTUALIZA`,
  `FECHA_ACTUALIZA`,
  `USUARIO_ANULA`,
  `FECHA_ANULA`,
  `USUARIO_ACTIVA`,
  `FECHA_ACTIVA`,
  `ANTICIPO_CTAXCOBRAR`,
  `ANTICIPO_CTAXPAGR`,
  0,
  IF(`STATUS`=1, "ACTIVO", "INACTIVO") AS estatus
  
FROM
  `bagsacorp`.`diario_cabecera`
;

UPDATE diario SET concepto=CONVERT(concepto USING utf8);

UPDATE diario SET concepto=REPLACE(concepto,'?','Ñ');

