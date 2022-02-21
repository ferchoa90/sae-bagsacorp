<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver Retención";
$this->params['breadcrumbs'][] = ['label' => 'Retenciones', 'url' => ['retenciones']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$contenido='<div style="line-height:30px;" class="row"><div class="col-4 col-md-4"><b>ID:  </b>'.$retencion->numero.'</div>';
$contenido='<div style="line-height:30px;" class="row"><div class="col-4 col-md-4"><b>Número:  </b>'.$retencion->comprobante.'</div>';
$contenido.='<div class="col-4 col-md-4"><b>Serie:  </b>'.$retencion->serie.'</div>';
$contenido.='<div class="col-4 col-md-4"><b>Fecha:  </b>'.$retencion->fecha.'<br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Proveedor:  </b>'.$retencion->proveedor0->nombre.'</div>';
$contenido.='<div class="col-12 col-md-12"><b>Proveedor:  </b>'.$retencion->proveedor0->direccion.'</div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
/*$contenido.='<div class="col-12 col-md-12"><b>Concepto:</b>&nbsp; '.$retencion->concepto.'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Porcentaje:</b>&nbsp; '.$retencion->porcentaje.'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Valor:</b>&nbsp; '.$retencion->valorretenido.'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Tipo de pago:</b>&nbsp; '.$retencion->baseimponible.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';*/

//$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

 if ($retencion->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$retencion->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$retencion->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$retencion->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 /*$contenido2.='<b>Fecha M.:</b>&nbsp; '.$retencion->fechaact.' </span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp; '.$retencion->usuarioactualizacion0->username. ' </span><br>';
 $contenido2.='<hr style="color: #0056b2;">';*/
 $contenido2.='</div>';

 $tabla='<table class="table table-striped">
 <thead>
   <tr>
     <th scope="col">Base Imp.</th>
     <th scope="col">Impuesto</th>
     <th scope="col" class="text-center">% retención</th>
     <th scope="col" class="text-center">Valor retenido</th>
   </tr>
 </thead>
 <tbody>';
$cont=0; $cont2=1; $tporcentaje=0; $tporcentaje=0;$tbaseimp=0;
 foreach ($retenciondetalle as $key => $value) {
    $scope= ($con==1)? $scope='scope="row"' : $scope='';
    $tbaseimp+=$value->baseimponible;
    $tporcentaje+=$value->porcentaje;
    $tvalor+=$value->valorretenido;

   // if ($value->debito==0){ $debe=$value->valor; $sumdebe+=$value->valor; $haber=0; }else{  $haber=$value->valor;  $sumhaber+=$value->valor; $debe=0;     }
    $tabla.=' <tr><td '.$scope.'>'.number_format($value->baseimponible,2).'</td><td>'.$value->concepto.'</td><td class="text-right">'.number_format($value->porcentaje,2).'</td>';
    $tabla.='<td class="text-right">'.number_format($value->valorretenido,2).'</td></tr>';
    $cont++; $cont2++;
    ($con==2)? $cont=0 : $cont=$cont;
 }
 $tabla.=' <tr><td '.$scope.'></td><td></td><td class="text-right"><b>TOTAL:</td>';
 $tabla.='<td class="text-right"><b>'.number_format($tvalor,2).'</b></td></tr>';
$tabla.='</tbody></table>';

    $contenido.=$tabla;





 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
