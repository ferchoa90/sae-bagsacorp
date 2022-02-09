<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver Banco";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Bancos', 'url' => ['bancos']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$contenido='<div style="line-height:30px;" class="row"><div class="col-4 col-md-4"><b>ID:  </b>'.$bancos->id.'</div>';
$contenido.='<div class="col-4 col-md-4"><b>Referencia:  </b>'.$bancos->referencia.'</div>';
$contenido.='<div class="col-4 col-md-4"><b>Fecha:  </b>'.$bancos->fecha.'<br></div>';
$contenido.='<div class="col-4 col-md-4"><b>Cuenta:  </b>'.$bancos->cuenta.'</div>';
$contenido.='<div class="col-4 col-md-4"><b>Diario:  </b>'.$bancos->diario.'</div>';
$contenido.='<div class="col-4 col-md-4"><b>N. Retención:  </b>'.$bancos->numeroretencion.'</div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>Beneficiario:</b>&nbsp; '.$bancos->beneficiario.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Concepto:</b>&nbsp; '.$bancos->concepto.'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Valor:</b>&nbsp; '.$bancos->valor.'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Tipo de pago:</b>&nbsp; '.$bancos->tipopagobanco0->nombre.'</span><br></div>';

//$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

 if ($bancos->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$bancos->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$bancos->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$bancos->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp; '.$bancos->fechaact.' </span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp; '.$bancos->usuarioactualizacion0->username. ' </span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

 $tabla='';



 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
