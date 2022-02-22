UPDATE cuentasporpagar SET concepto=CONVERT(concepto USING utf8);

UPDATE cuentasporpagar SET concepto=REPLACE(concepto,'?','Ñ');