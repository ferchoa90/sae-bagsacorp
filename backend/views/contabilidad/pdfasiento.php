<?php
use yii\helpers\Html;
use yii\helpers\Url;



?>

<!DOCTYPE html>
<meta charset="utf-8">
<head>
<link rel="stylesheet" media="print" href="/backend/web/css/sitepdf.css" />
</head>
<body>
<img src= "/backend/web/images/logo.png" width="20%">

<table style="width: 100%;" class="font-10">
    <tr><td> <b>Diario N° :</b> <?=$asiento->anio.' - '.$asiento->diario?></tr>
    <tr><td> <b>Emisión : </b>Durán, <?= date_format(date_create($asiento->fecha),'d - m - Y') ?> </td></tr>
    <tr><td> <b>Concepto :</b>  <?=$asiento->concepto ?> </td></tr>
    <tr><td> <b>Tipo :</b>  <?=$asiento->tipodiario->nombre ?> </td></tr>
</table>
<hr>
<table class="borderbottom font-10" width="100%" >
    <thead>
        <tr  class="borderbottom" align="center">
            <td width="15%" > Cuenta </td>
            <td width="25%"> Nombre </td>
            <td width="40%"> Referencia </td>
            <td width="10%" class="text-center"> Débito </td>
            <td width="10%" class="text-center"> Crédito </td>
        </tr>
    </thead>

</table>
<table class=" font-10" width="100%" >
    <tbody>

        <?php foreach ($asientodetalle as $key => $value) { ?>
        <?php if ($value->debito==0){ $debe=$value->valor; $sumdebe+=$value->valor; $haber=0; }else{  $haber=$value->valor;  $sumhaber+=$value->valor; $debe=0;     } ?>
        <tr  class="" align="center">
            <td width="15%" > <?=$value->cuenta ?>  </td>
            <td width="25%">  <?=$value->cuentacontable0->nombre?>  </td>
            <td width="40%">  <?=$value->concepto ?>  </td>
            <td width="10%" class="text-right">  <?=number_format($debe,2) ?>  </td>
            <td width="10%" class="text-right">  <?=number_format($haber,2) ?>  </td>
        </tr>
        <?php } ?>
    </tbody>

</table>
<table class="bordertop font-10" width="100%" >
    <thead>
        <tr  class="" align="center">
            <td width="15%" ></td>
            <td width="25%"> </td>
            <td width="40%" class="text-right"> <b>Total</b> </td>
            <td width="10%" class="text-right"> <b><?=number_format($sumdebe,2)?></b> </td>
            <td width="10%" class="text-right"> <b><?=number_format($sumhaber,2)?></b> </td>
        </tr>
    </thead>

</table>

<hr>
 <br><br><br>


<table  width="100%"  class="font-10 lh-20">
    <tr>

        <td width="33%" class="pad-20 text-center"><hr><b>Elaborado por:</b> <br><?= Yii::$app->user->identity->nombres.' '.    Yii::$app->user->identity->apellidos    ; ?></td>
        <td width="33%" class="pad-20 text-center"><hr><b>Revisado</b><br>&nbsp; </td>
        <td width="33%" class="pad-20 text-center"><hr><b>Autorizado</b><br>&nbsp;</td>

    </tr>

</table>

</b>

</body>

</html>