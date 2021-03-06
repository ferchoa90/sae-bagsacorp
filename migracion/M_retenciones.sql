

INSERT INTO `dbbagsacorp`.`retenciones` (
  `id`,
  `origencomprobante`,
  `numero`,
  `item`,
  `serie`,
  `fecha`,
  `tipo`,
  `origen`,
  `proveedor`,
  `rubro`,
  `tiporetencion`,
  `concepto`,
  `porcentaje`,
  `valoretenido`,
  `baseimponible`,
  `comprobante`,
  `tipocomprobante`,
  `identificacion`,
  `tipoidentificacion`,
  `direccion`,
  `ciudad`,
  `beneficiario`,
  `autorizacion`,
  `validez`,
  `retencionaut`,
  `tipodocumento`,
  `usuariodeclara`,
  `fechadeclara`,
  `declaracionmov`,
  `usuariocreacion`,
  `fechacreacion`,
  `isDeleted`,
  `estatus`
)
SELECT
  NULL,
  `ORIGEN_COMPROBANTE_ELECTRONICO`,
  `NUMERO`,
  `ITEM`,
  `SERIE`,
  `FECHA`,
  `TIPO`,
  `ORIGEN`,
  `PROVEEDOR`,
  `RUBRO`,
  `TIPO_RETENCION`,
  `CONCEPTO`,
  `PORCENTAJE`,
  `VALOR_RETENIDO`,
  `BASE_IMPONIBLE`,
  `COMPROBANTE`,
  `TIPO_COMPROBANTE`,
  `IDENTIFICACION`,
  `TIPO_IDENTIFICACION`,
  `DIRECCION`,
  `CIUDAD`,
  `BENEFICIARIO`,
  `AUTORIZACION`,
  `VALIDEZ`,
  `RETENCION_AUTORIZACION`,
  `TIPO_DOCUMENTO_AUTORIZADO`,
  `USUARIO_DECLARA`,
  `FECHA_DECLARA`,
  `DECLARACION_MOVIMIENTO`,
  1,
  NULL,
  0,
   IF(`STATUS`=1, "ACTIVO", "INACTIVO") AS estatus
FROM
  `bagsacorp`.`retencion` 
;


