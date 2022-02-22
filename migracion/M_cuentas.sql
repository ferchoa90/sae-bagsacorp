DELETE FROM cuentas;
INSERT INTO `dbbagsacorp`.`cuentas` (
  `id`,
  `codigoant`,
  `parent`,
  `codigo`,
  `inputa`,
  `nombre`,
  `descripcion`,
  `numero`,
  `saldo`,
  `cheque`,
  `isDeleted`,
  `usuariocreacion`,
  `fechacreacion`,
  `usuarioact`,
  `fechaact`,
  `usuarioan`,
  `fechaan`,
  `usuarioac`,
  `fechaac`,
  `estatus`
)

SELECT
  NULL,
  `CODIGO`,
  0,
  0,
  `INPUTA`,
  `NOMBRE`,
  ' ',
  `NUMERO`,
  `SALDO`,
  `CHEQUE`,
   0,
  `USUARIO_INGRESA`,
  `FECHA_INGRESA`,
  `USUARIO_ACTUALIZA`,
  `FECHA_ACTUALIZA`,
  `USUARIO_ANULA`,
  `FECHA_ANULA`,
  `USUARIO_ACTIVA`,
  `FECHA_ACTIVA`,
  IF(`STATUS`=1, "ACTIVO", "INACTIVO") AS estatus
FROM
  `bagsacorp`.`cuentas`;
 
