<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use common\models\Factura;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver cuenta por cobrar";
$this->params['breadcrumbs'][] = ['label' => 'Administración de CXP', 'url' => ['cuentasporcobrar']];
$this->params['breadcrumbs'][] = $this->title;


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

$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>Diario # </b>'.$cuenta->diario.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Fecha:</b>&nbsp; '.$cuenta->fecha.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Cliente:</b>&nbsp; '.$cuenta->idcliente0->razonsocial.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Número:</b>&nbsp; '.$cuenta->id.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>Concepto:</b>&nbsp; '.$cuenta->concepto.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Tipo:</b>&nbsp; '.$tipo .'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Valor:</b>&nbsp;$ '.$cuenta->valor.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Factura:</b>&nbsp;$ '.$cuenta->valor.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ACTIVO</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$cuenta->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$cuenta->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp; - </span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp; - </span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

 $tabla='<table class="table table-striped">
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
$cont=0; $cont2=1; $sumdebe=0; $sumhaber=0;
 foreach ($cuentadetalle as $key => $value) {
     $factura=Factura::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO","nfactura"=>$cuentadetalle->numerofactura])->orderBy(["id" => SORT_DESC])->all();
     foreach ($factura as $key => $value) {
        $scope= ($con==1)? $scope='scope="row"' : $scope='';
        //if ($value->debito==0){ $debe=$value->valor; $sumdebe+=$value->valor; $haber=0; }else{  $haber=$value->valor;  $sumhaber+=$value->valor; $debe=0;     }
        $tabla.=' <tr><td '.$scope.'>'.$cont2.'</td><td>'.$value->concepto.'</td><td class="text-right">'.number_format($debe,2).'</td><td class="text-right">'.number_format($haber,2).'</td>';
        $tabla.=' <td '.$scope.'>'.$cont2.'</td><td>'.$value->concepto.'</td><td class="text-right">'.number_format($debe,2).'</td><td class="text-right">'.number_format($haber,2).'</td></tr>';
        $cont++; $cont2++;
        ($con==2)? $cont=0 : $cont=$cont;
    }
    
 }
$tabla.='<tr><td colspan="2"></td><td class="text-right"><b>'.number_format($sumdebe,2).'</b></td><td class="text-right"><b>'.number_format($sumhaber,2).'</b></td> </tr>';

   $tabla.='</tbody>
</table>';

    $contenido.=$tabla;

 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
