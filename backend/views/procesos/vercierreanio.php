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


$this->title = "Ver Cierre de Año";
$this->params['breadcrumbs'][] = ['label' => 'Cierre año', 'url' => ['cierredeanio']];
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

$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>Id: </b>'.$cierreanio->id.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Periodo: </b>'.$cierreanio->idperiodo0->descripcion.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Año inicio: </b>'.$cierreanio->idperiodo0->anioinicio.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Año fin: </b>'.$cierreanio->idperiodo0->aniofin.'<br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
//$contenido.='<div class="col-6 col-md-3"><b>Iva:</b>&nbsp; '.$cierreanio->ivatotal.'</span><br></div>';
//$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

if ($cierreanio->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$cierreanio->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$cierreanio->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$cierreanio->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp; - </span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp; - </span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

 $tabla='<div style="height: 400px; overflow-y:scroll;"><table class="table table-striped">
 <thead>
   <tr>
     <th scope="col">#</th>
     <th scope="col" class="text-left">Padre</th>
     <th scope="col" class="text-left">Código</th>
     <th scope="col" class="text-left">Cuenta</th>
     <th scope="col" class="text-center">Saldo</th>
   </tr>
 </thead>
 <tbody>';
$cont=1; $cont2=1; $sumdebe=0; $sumhaber=0;
 foreach ($cierreaniodetalle as $key => $value) {
    $scope= ($con==1)? $scope='scope="row"' : $scope='';
    //if ($value->debito==0){ $debe=$value->valor; $sumdebe+=$value->valor; $haber=0; }else{  $haber=$value->valor;  $sumhaber+=$value->valor; $debe=0;     }
    $tabla.=' <tr><td '.$scope.'>'.$cont.'</td><td>'.$value->padre.'</td><td>'.$value->codigo.'</td>';
    $tabla.='<td class="text-left">'.$value->cuentacontable->nombre.'</td><td class="text-right">'.number_format($value->saldo,3).'</td></tr>';
    $cont++; $cont2++;
    ($con==2)? $cont=0 : $cont=$cont;
 }
//$tabla.='<tr><td colspan="2"></td><td class="text-right"><b>'.number_format($sumdebe,2).'</b></td><td class="text-right"><b>'.number_format($sumhaber,2).'</b></td> </tr>';

   $tabla.='</tbody>
</table></div>';

    $contenido.=$tabla;

//var_dump($inventario->inventariodetalle0->id );
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

?>
