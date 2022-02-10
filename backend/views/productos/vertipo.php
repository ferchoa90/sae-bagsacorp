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


$this->title = "Ver Tipo";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Tipo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$cuentaID=New Contabilidad_cuentas;
$cuentainv= $cuentaID->getCuenta($model->cuentainv);
$cuentaventas= $cuentaID->getCuenta($model->cuentaventas);
$cuentaventasdes= $cuentaID->getCuenta($model->cuentaventasdes);
$cuentaventasdev= $cuentaID->getCuenta($model->cuentaventasdev);
$cuentacostos= $cuentaID->getCuenta($model->cuentacostos);
$cuentacostosdes= $cuentaID->getCuenta($model->cuentacostosdes);
$cuentacostosdev= $cuentaID->getCuenta($model->cuentacostosdev);
$cuentaentradainv= $cuentaID->getCuenta($model->cuentaentradainv);
$cuentasalidainv= $cuentaID->getCuenta($model->cuentasalidainv);
$cuentasalidamue= $cuentaID->getCuenta($model->cuentasalidamue);


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

$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>Tipo: </b>'.$model->nombre.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>ID:</b>&nbsp; '.$model->id.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cuenta Inventario:</b>&nbsp; '.$cuentainv.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cuenta Ventas:</b>&nbsp;$ '.$cuentaventas.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cuenta Ventas Descuento:</b>&nbsp;'.$cuentaventasdes.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cuenta Ventas Devolución:</b>&nbsp;'.$cuentaventasdev.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cuenta Costos:</b>&nbsp;'.$cuentacostos.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cuenta Costos Descuentos:</b>&nbsp;'.$cuentacostosdes.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cuenta Costos Devolución:</b>&nbsp;'.$cuentacostosdev.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cuenta Entrada Inv.:</b>&nbsp;'.$cuentaentradainv.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cuenta Salida Inv.:</b>&nbsp;'.$cuentasalidainv.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cuenta Salida Muestras:</b>&nbsp;'.$cuentasalidamue.'</span><br></div>';

$contenido.='</div>';

if ($model->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$model->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$model->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$model->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp;'.$model->usuarioactualizacion0->username. '</span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp;'.$model->fechaact. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';





 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

?>
