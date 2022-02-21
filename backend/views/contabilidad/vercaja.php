<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver Caja";
$this->params['breadcrumbs'][] = ['label' => 'Caja', 'url' => ['caja']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$contenido='<div style="line-height:30px;" class="row"><div class="col-4 col-md-4"><b>ID:  </b>'.$caja->id.'</div>';
//$contenido.='<div class="col-4 col-md-4"><b>Tipo:  </b>'.$caja->tipo.'</div>';
$contenido.='<div class="col-4 col-md-4"><b>Diario:  </b>'.$caja->diario.'<br></div>';
$contenido.='<div class="col-4 col-md-4"><b>Fecha:  </b>'.$caja->fecha.'<br></div>';
$contenido.='<div class="col-4 col-md-4"><b>Disponible:  </b>'.$caja->disponible.'<br></div>';
$contenido.='<div class="col-4 col-md-4"><b>Cta. (Otros):  </b>'.$caja->cuentaotros.'<br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Referencia:  </b>'.$caja->referencia.'<br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>Beneficiario:</b>&nbsp; '.$caja->beneficiario.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Concepto:</b>&nbsp; '.$caja->concepto.'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Valor:</b>&nbsp; '.$caja->valor.'</span><br></div>';
//$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';

//$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

 if ($caja->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$caja->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$caja->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$caja->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 /*$contenido2.='<b>Fecha M.:</b>&nbsp; '.$caja->fechaact.' </span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp; '.$caja->usuarioactualizacion0->username. ' </span><br>';
 $contenido2.='<hr style="color: #0056b2;">';*/
 $contenido2.='</div>';


 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
