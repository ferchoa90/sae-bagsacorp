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

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */
$userData = GlobalData::getUserDataById($model->usuariocreacion);
$flagDataMod = false;


$this->title = "Ver Inventario";
$this->params['breadcrumbs'][] = ['label' => 'Inventario', 'url' => ['Agregar Stock']];
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

$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>Id: </b>'.$inventario->numero.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Días Plazo: </b>'.$inventario->diasplazo.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Referencia:</b>&nbsp; '.$inventario->referencia.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Costo:</b>&nbsp; '.$inventario->costo.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Total Iva:</b>&nbsp; '.$inventario->totaliva.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Total Ice:</b>&nbsp; '.$inventario->totalivaice.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Total:</b>&nbsp; '.$inventario->total.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Vencimiento:</b>&nbsp; '.$inventario->vencimiento.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Diario:</b>&nbsp; '.$inventario->diario.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-6 col-md-3"><b>Iva:</b>&nbsp; '.$inventario->ivatotal.'</span><br></div>';
$contenido.='<div class="col-6 col-md-3"><b>Fecha:</b>&nbsp; '.$inventario->fecha.'</span><br></div>';
$contenido.='<div class="col-6 col-md-3"><b>Validez:</b>&nbsp; '.$inventario->validez.'</span><br></div>';
$contenido.='<div class="col-6 col-md-3"><b>Retencion:</b>&nbsp; '.$inventario->retencion.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Notas:</b>&nbsp; '.$inventario->notas.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Autorización:</b>&nbsp; '.$inventario->autorizacion.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

if ($inventario->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$inventario->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$inventario->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$inventario->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp;'.$inventario->usuarioactualizacion0->username. '</span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp;'.$inventario->fechaact. '</span><br>';
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

//var_dump($inventario->inventariodetalle0->id );
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

?>
