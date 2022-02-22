<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver asiento";
$this->params['breadcrumbs'][] = ['label' => 'Asientos', 'url' => ['asientos']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$botonP=$botones->getBotongridArray(
   array(
      array('tipo'=>'link','nombre'=>'pdf', 'id' => 'pdf', 'titulo'=>'&nbsp;PDF', 'link'=>'pdfasiento?id='.$asiento->id, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'pdf','tamanio'=>'pequeño','target'=>'blank',  'adicional'=>'')

));

$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>Diario # </b>'.$asiento->diario.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Fecha:</b>&nbsp; '.$asiento->fecha.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>Concepto:</b>&nbsp; '.$asiento->concepto.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Tipo Diario:</b>&nbsp;'.$asiento->tipodiario->nombre.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Total:</b>&nbsp;$ '.$asiento->total.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Tipo Auxiliar:</b>&nbsp;'.$asiento->tipoaux.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Anticipo CXP:</b>&nbsp;'.$asiento->anticipoctaxp.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Anticipo CXC:</b>&nbsp;'.$asiento->anticipoctaxc.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

 if ($asiento->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$asiento->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$asiento->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$asiento->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp; '.$asiento->fechaact.' </span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp; '.$asiento->usuarioactualizacion0->username. ' </span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

 $tabla='<table class="table table-striped">
 <thead>
   <tr>
     <th scope="col">#</th>
     <th scope="col">Concepto</th>
     <th scope="col" class="text-center">Debe</th>
     <th scope="col" class="text-center">Haber</th>
   </tr>
 </thead>
 <tbody>';
$cont=0; $cont2=1; $sumdebe=0; $sumhaber=0;
 foreach ($asientodetalle as $key => $value) {

    $scope= ($con==1)? $scope='scope="row"' : $scope='';
    if ($value->debito==0){ $debe=$value->valor; $sumdebe+=$value->valor; $haber=0; }else{  $haber=$value->valor;  $sumhaber+=$value->valor; $debe=0;     }
    $tabla.=' <tr><td '.$scope.'>'.$cont2.'</td><td>'.$value->concepto.'</td><td class="text-right">'.number_format($debe,2).'</td><td class="text-right">'.number_format($haber,2).'</td></tr>';
    $cont++; $cont2++;
    ($con==2)? $cont=0 : $cont=$cont;
 }
$tabla.='<tr><td colspan="2"></td><td class="text-right"><b>'.number_format($sumdebe,2).'</b></td><td class="text-right"><b>'.number_format($sumhaber,2).'</b></td> </tr>';

   $tabla.='</tbody>
</table>';

    $contenido.=$tabla;

 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC.$botonP),
        array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
