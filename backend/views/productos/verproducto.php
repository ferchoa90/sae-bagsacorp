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


$this->title = "Ver Producto";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Productos', 'url' => ['index']];
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

$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>Id: </b>'.$producto->id.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Código: </b>'.$producto->codigo.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Presentacion:</b>&nbsp; '.$producto->presentacion0->nombre.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Línea:</b>&nbsp; '.$producto->tipoproducto0->nombre.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Color:</b>&nbsp; '.$producto->color0->nombre.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Unidad:</b>&nbsp; '.$producto->tipounidad0->nombre.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Característica:</b>&nbsp; '.$producto->caracteristica0->nombre.'</span><br></div>';
//$contenido.='<div class="col-6 col-md-6"><b>Cliente:</b>&nbsp; '.$producto->idcliente0->razonsocial.'</span><br></div>';
//$contenido.='<div class="col-6 col-md-6"><b>Número:</b>&nbsp; '.$producto->id.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>Nombre:</b>&nbsp; '.$producto->nombreproducto.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Características:</b>&nbsp; '.$producto->caracteristicas.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>producto #</b>&nbsp; '.$productobanco.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
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
