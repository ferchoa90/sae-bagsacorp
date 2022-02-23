SELECT *
FROM factura
WHERE idcliente=28 AND fecha
BETWEEN  '2021-11-01' AND '2021-12-31';

2021-23494 (2497) -- 109463 --- 463742-46

17260 --- ctas por cobrar



SELECT * FROM diario WHERE anio='2021' AND diario='23494';  ---
SELECT * FROM diariodetalle WHERE anio='2021' AND diario='23494';


SELECT * FROM cuentasporcobrar WHERE idfactura="2497";
SELECT * FROM cuentasporcobrar WHERE id="17260";
SELECT * FROM cuentasporcobrardet WHERE numerofactura="17261";

SELECT * FROM retencioncxc WHERE facturanum=2497;

SELECT * FROM banco WHERE cartera=17904;



2021-27976 -- mov banco 24283 14865.53  --- 10635  ---- 17376