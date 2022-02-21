INSERT INTO `dbbagsacorp`.`cierreaniodetalle` (
  `id`,
  `item`,
  `anio`,
  `codigo`,
  `saldo`,
  `PADRE`,
  `INPUTA`,
  `isDeleted`,
  `estatus`
)

SELECT
   NULL,
  `NUMERO`,
  `ANIO`,
  `CODIGO`,
  `SALDO`,
  `PADRE`,
  `INPUTA`,
  0,
  'ACTIVO'  
FROM
  `bagsacorp`.`cierre_anio_detalle`
`cierreaniodetalle`

;

