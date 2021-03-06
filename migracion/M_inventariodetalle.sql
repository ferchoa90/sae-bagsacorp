INSERT INTO `dbbagsacorp`.`inventariodetalle` (
  `id`,
  `numero`,
  `item`,
  `tipomovimiento`,
  `fecha`,
  `articulo`,
  `cantidad`,
  `valorunitario`,
  `costo`,
  `descuento`,
  `ivalinea`,
  `bodegaorigen`,
  `bodegadestino`,
  `liquidacion`,
  `valorparcial`,
  `valoriva`,
  `valordescuento`,
  `hora`,
  `cantidadad`,
  `unidadad`,
  `valorunitad`,
  `valorparcialad`,
  `costounitarioad`,
  `valordescad`,
  `ivavaladic`,
  `rangodesdead`,
  `rangohastaad`,
  `rangodefadic`,
  `rangoivagrabado`,
  `rangosubivacero`,
  `isDeleted`,
  `estatus`
)

SELECT
  NULL,
  `NUMERO`,
  `ITEM`,
  `TIPO_MOVIMIENTO`,
  `FECHA`,
  `ARTICULO`,
  `CANTIDAD`,
  `VALOR_UNITARIO`,
  `COSTO`,
  `DESCUENTO_LINEA`,
  `IVA_LINEA`,
  `BODEGA_ORIGEN`,
  `BODEGA_DESTINO`,
  `LIQUIDACION_COMPRA`,
  `VALOR_PARCIAL`,
  `VALOR_IVA`,
  `VALOR_DESCUENTO`,
  `HORA`,
  `CANTIDAD_ADICIONAL`,
  `UNIDAD_ADICIONAL`,
  `VALOR_UNITARIO_ADICIONAL`,
  `VALOR_PARCIAL_ADICIONAL`,
  `COSTO_UNITARIO_ADICIONAL`,
  `VALOR_DESCUENTO_ADICIONAL`,
  `IVA_VALOR_ADICIONAL`,
  `RANGO_DESDE_ADICIONAL`,
  `RANGO_HASTA_ADICIONAL`,
  `RANGO_DEFECTO_ADICIONAL`,
  `RANGO_SUBTOTAL_IVA_GRAVADO_ADICIONAL`,
  `RANGO_SUBTOTAL_IVA_CERO_ADICIONAL`,
  0,
  IF(`STATUS`=1, "ACTIVO", "INACTIVO") AS estatus
FROM
  `bagsacorp`.`inventario_detalle`

  ;

