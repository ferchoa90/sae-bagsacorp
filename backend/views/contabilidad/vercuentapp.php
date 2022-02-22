<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Navs;
use backend\components\Iconos;
use common\models\Factura;
use common\models\Banco;
use common\models\Diario;
use common\models\Diariodetalle;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver cuenta por pagar";
$this->params['breadcrumbs'][] = ['label' => 'Cuentas por pagar', 'url' => ['cuentasporpagar']];
$this->params['breadcrumbs'][] = $this->title;

$nav= new Navs;
$objeto= new Objetos;
$div= new Bloques;

//var_dump($clientes);




 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-9 col-xs-12 ','','','','');
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-3 col-xs-12 ','','','','');
 //echo $contenido;
 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$tipo=($cuenta->tipo=='D')? 'DÉBITO' : 'CRÉDITO';
$formapago=($cuenta->formapago)? $cuenta->formacobro0->nombre : '';

$cont=0; $cont2=1; $sumdebe=0; $sumhaber=0;
$banco=Banco::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO","id"=>$cuenta->movimientobanco])->one();

$length = 7;
$char = 0;
$type = 'd';
$format = "%{$char}{$length}{$type}"; // or "$010d";
$abono=0;

 foreach ($cuentadetalle as $key => $value) {

     $factura=Factura::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO","nfactura"=>$value->cheque])->orderBy(["id" => SORT_DESC])->all();
     //var_dump($factura);
     foreach ($factura as $key => $valueFac) {
        //var_dump($valueFac->cpc0->concepto);
        $scope= ($con==1)? $scope='scope="row"' : $scope='';
        //if ($value->debito==0){ $debe=$value->valor; $sumdebe+=$value->valor; $haber=0; }else{  $haber=$value->valor;  $sumhaber+=$value->valor; $debe=0;     }
        $tablacontent.=' <tr><td '.$scope.'>'.$cont2.'</td><td>'.$valueFac->canal.'-'.sprintf($format, $valueFac->nfactura).'</td><td>'.$value->numerofactura.'</td><td class="text-right">'.$valueFac->diario0->tipoaux.'</td><td>'.$valueFac->fecha.'</td>';
        $tablacontent.=' <td '.$scope.'>'.$valueFac->vencimiento.'</td><td>'.number_format($valueFac->total,2).'</td><td class="text-right">'.number_format($value->valor,2).'</td><td class="text-right">-</td>';
        $tablacontent.=' <td >'.$valueFac->cpc0->concepto.'</td><td>'.$valueFac->diario.'</td></tr>';
        $abono+=$value->valor;
        $cont++; $cont2++;
        ($con==2)? $cont=0 : $cont=$cont;
    }

 }

$cuentabanco="";
$cont=0; $cont2=1; $sumdebe=0; $sumhaber=0; $valdebe=0; $valhaber=0;
$diario=Diario::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO","diario"=>substr($cuenta->diario,5)])->one();
$diariodet=Diariodetalle::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO","diario"=>$diario->diario])->all();
foreach ($diariodet as $key => $valueDia) {
  if ($valueDia->debito==1){ $sumdebe+=$valueDia->valor; $valdebe=$valueDia->valor; $valhaber=0; $cuentabanco=$valueDia->cuentas0[0]->nombre.' - CUENTA N° '.$valueDia->cuentas0[0]->numero; }
  if ($valueDia->debito==0){ $sumhaber+=$valueDia->valor; $valhaber=$valueDia->valor; $valdebe=0; }
  $scope= ($con==1)? $scope='scope="row"' : $scope='';
  $tablacontent2.=' <tr> <td>'.$valueDia->cuenta.'</td><td>'.$valueDia->cuentas0[0]->nombre.' </td>  <td class="">'.$valueDia->concepto.'</td>';
  $tablacontent2.=' <td '.$scope.'>'.number_format($valdebe,2).'</td><td>'.number_format($valhaber,2).'</td></tr>';
  $cont++; $cont2++;
  ($con==2)? $cont=0 : $cont=$cont;

}

//$tablacontent.='<tr><td colspan="2"></td><td class="text-right"><b>'.number_format($sumdebe,2).'</b></td><td class="text-right"><b>'.number_format($sumhaber,2).'</b></td> </tr>';
$tablacontent.='</tbody></table></div>';
$tablacontent2.='</tbody></table></div>';

$tablacontent.='<div class="row p-2"><div class="col-12 col-md-3 ">&nbsp;</div><div class="col-12 col-md-3 ">&nbsp;</div>';
$tablacontent.='<div class="col-12 col-md-6 row bg-light"><div class="col-12 col-md-6  ">&nbsp;</div><div class="col-12 col-md-6  "></div></div></div>';


$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>Diario # </b>'.$cuenta->diario.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Fecha:</b>&nbsp; '.$cuenta->fecha.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Proveedor:</b>&nbsp; '.$cuenta->proveedor->nombre.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Número:</b>&nbsp; '.$cuenta->id.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>Concepto:</b>&nbsp; '.$cuenta->concepto.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Tipo:</b>&nbsp; '.$tipo .'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Valor:</b>&nbsp;$ '.$cuenta->valor.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cuenta #</b>&nbsp; '.$cuentabanco.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Forma de cobro:</b>&nbsp; '.$formapago .'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Comprobante # </b>&nbsp; '.$banco->referencia.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Movimiento Bancos # </b>&nbsp; '.$cuenta->movimientobanco.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Disponibilidad: </b>&nbsp;'.$banco->disponible.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

if(@$cuenta->usuarioact){ $usuariomod=$cuenta->usuariomodificacion0->username; } else{ $usuariomod=" - "; }
if(@$cuenta->fechaact){ $fechamod=$cuenta->fechaact; } else{ $fechamod=" - ";  }

if ($cuenta->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$cuenta->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$cuenta->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$cuenta->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp;'.$usuariomod.'</span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp;'.$fechamod.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';


 $tabla='<div style="overflow-x: scroll;"><table class="table table-striped">
 <thead>
   <tr>
     <th scope="col">#</th>
     <th scope="col">Comprobante</th>
     <th scope="col" class="text-center">Movimiento</th>
     <th scope="col" class="text-center">Tipo</th>
     <th scope="col" class="text-center">Emisión</th>
     <th scope="col" class="text-center">Vencimiento</th>
     <th scope="col" class="text-center">Valor</th>
     <th scope="col" class="text-center">Abono</th>
     <th scope="col" class="text-center">Saldo</th>
     <th scope="col" class="text-center">Concepto</th>
     <th scope="col" class="text-center">Diario</th>
   </tr>
 </thead>
 <tbody>';

 $tabla2='<div style="overflow-x: scroll;"><table class="table table-striped">
 <thead>
   <tr>
     <th scope="col" class="text-center">Código</th>
     <th scope="col" class="text-center">Nombre</th>
     <th scope="col" class="text-center">Referencia</th>
     <th scope="col" class="text-center">Debe</th>
     <th scope="col" class="text-center">Haber</th>
   </tr>
 </thead>
 <tbody><br>'.$contentResultados2;

$contentResultados2='<div class="row p-2"><div class="col-12 col-md-3 ">&nbsp;</div><div class="col-12 col-md-3 ">&nbsp;</div>';
$contentResultados2.='<div class="col-12 col-md-6 row bg-light"><div class="col-12 col-md-6  "><b>DEBE: </b>$ '.$sumdebe.'</div><div class="col-12 col-md-6 "><b>HABER:</b>$ '.$sumhaber.'</div></div></div>';

$contenidotab=$nav->getNavsarray(
  array(
      array('tipo'=>'config','nombre'=>'tabpermisos', 'id'=>'tabpermisos', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
      array('tipo'=>'tab','nombre'=>'tabfactura', 'id'=>'tabfactura', 'titulo'=>'Facturas', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$tabla.$tablacontent),
      array('tipo'=>'tab','nombre'=>'tabdiario', 'id'=>'tabdiario', 'titulo'=>'Diario', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$tabla2.$tablacontent2.$contentResultados2),
  )
);

 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$contenidotab.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
