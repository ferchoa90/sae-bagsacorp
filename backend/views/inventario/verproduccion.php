<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\Globaldata;
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Contabilidad_cuentas;
use backend\models\Slider;
use yii\helpers\Url;

$this->title = "Ver orden de producción";
$this->params['breadcrumbs'][] = ['label' => 'Inventario', 'url' => ['produccion']];
$this->params['breadcrumbs'][] = $this->title;

$objeto= new Objetos;
$div= new Bloques;

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')
));
//$ivagr= ($inventario->grabaiva==1)? 'Sí' : 'No';
//$tipoprod= ($inventario->tipo==1)? 'PRODUCTO' : 'SERVICIO';

$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-4"><b>Id: </b>'.$produccion->id.'<br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Fecha: </b>'.$produccion->fecha.'<br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Referencia:</b>&nbsp; '.$produccion->referencia.'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Cuenta:</b>&nbsp; '.$produccion->cuenta.'</span><br></div>';

$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-6 col-md-12"><b>Artículo:</b>&nbsp; '.$produccion->articulo.'</span><br></div>';
$contenido.='<div class="col-6 col-md-12"><b>Concepto:</b>&nbsp; '.$produccion->concepto.'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Turno:</b>&nbsp; '.$produccion->turno0->nombre.'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Costo Producción:</b>&nbsp; '.number_format($produccion->costoproduccion,2).'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Unidades Producción:</b>&nbsp; '.number_format($produccion->unidadesprod,2).'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Kilos Producción:</b>&nbsp; '.number_format($produccion->kilosprod,2).'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Material Preparado:</b>&nbsp; '.number_format($produccion->materialprep,2).'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Desperdicio:</b>&nbsp; '.number_format($produccion->desperdicio,2).'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Diferencia:</b>&nbsp; '.number_format($produccion->diferencia,2).'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Costo Prod. Adicional:</b>&nbsp; '.number_format($produccion->costoprodadicional,2).'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Rango Adicional:</b>&nbsp; '.number_format($produccion->rangodefadicional,2).'</span><br></div>';
$contenido.='<div class="col-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-6 col-md-4"><b>Cierre Turno:</b>&nbsp; '.$produccion->cierre.'</span><br></div>';
$contenido.='<div class="col-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

if ($produccion->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$produccion->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$produccion->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$produccion->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp;'.$produccion->usuarioactualizacion0->username. '</span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp;'.$produccion->fechaact. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

 $tabla='<table class="table table-striped">
 <thead>
   <tr>
     <th scope="col">#</th>
     <th scope="col">Producto</th>
     <th scope="col" class="text-center">Cantidad</th>
     <th scope="col" class="text-center">Valor Un.</th>
     <th scope="col" class="text-center">Descuento</th>
     <th scope="col" class="text-center">Iva</th>
     <th scope="col" class="text-center">Valor P.</th>
   </tr>
 </thead>
 <tbody>';
$cont=0; $cont2=1; $sumdebe=0; $sumhaber=0;
 foreach ($inventario->inventariodetalle0 as $key => $value) {
    $scope= ($con==1)? $scope='scope="row"' : $scope='';
    //if ($value->debito==0){ $debe=$value->valor; $sumdebe+=$value->valor; $haber=0; }else{  $haber=$value->valor;  $sumhaber+=$value->valor; $debe=0;     }
    $tabla.=' <tr><td '.$scope.'>'.$cont2.'</td><td>'.$value->articulo.'</td><td class="text-right">'.$value->cantidad.'</td><td class="text-right">'.number_format($value->valorunitario,2).'</td><td class="text-right">'.number_format($value->descuento,2).'</td><td class="text-right">'.number_format($value->ivalinea,2).'</td><td class="text-right">'.number_format($value->valorparcial,2).'</td></tr>';
    $cont++; $cont2++;
    ($con==2)? $cont=0 : $cont=$cont;
 }
//$tabla.='<tr><td colspan="2"></td><td class="text-right"><b>'.number_format($sumdebe,2).'</b></td><td class="text-right"><b>'.number_format($sumhaber,2).'</b></td> </tr>';

   $tabla.='</tbody>
</table>';

    $contenido.=$tabla;

var_dump($inventario->inventariodetalle0->id );


 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

?>
