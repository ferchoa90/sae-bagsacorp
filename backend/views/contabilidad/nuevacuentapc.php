<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use backend\components\Grid;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Nueva cuenta por cobrar";
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

//var_dump($clientes);



 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'cliente', 'id'=>'cliente', 'valor'=>$clientes, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cliente: ', 'col'=>'col-12 col-md-8', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'tipocuenta', 'id'=>'tipocuenta', 'valor'=>$tipocuenta, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Tipo Cuenta: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'fecha', 'nombre'=>'fechaemision', 'id'=>'fechaemision', 'valor'=>date("Y-m-d"), 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'calendario','boxbody'=>false,'etiqueta'=>'Fecha emisión: ', 'col'=>'col-12 col-md-5', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'valor', 'id'=>'valor', 'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Valor: ', 'col'=>'col-12 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'textarea', 'nombre'=>'concepto', 'id'=>'concepto', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Concepto: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'formacobro', 'id'=>'formacobro', 'valor'=>$formacobro, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Forma Cobro: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'banco', 'id'=>'banco', 'valor'=>$bancos, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Banco: ', 'col'=>'col-12 col-md-5', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cuenta', 'id'=>'cuenta', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cuenta N: ', 'col'=>'col-12 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cheque', 'id'=>'cheque', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cheque N: ', 'col'=>'col-12 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'fecha', 'nombre'=>'fechaemision', 'id'=>'fechaemision', 'valor'=>date("Y-m-d"), 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'calendario','boxbody'=>false,'etiqueta'=>'Fecha vencimiento: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
 
    ),true
);
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-9 col-xs-12 ','','','','');
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-3 col-xs-12 ','','','','');
 //echo $contenido;
 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));


 $contenido2='<div style="line-height:25px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ACTIVO</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Debe:</b>&nbsp;&nbsp;&nbsp;$ 0.00<br>';
 $contenido2.='<b>Haber:</b>&nbsp;&nbsp;&nbsp;$ 0.00<br></div>';
 $contenido2.='<hr style="color: #0056b2;">';

 $grid= new Grid;

$cabecera= array(
    array('titulo'=>'Código', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('titulo'=>'Nombre', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('titulo'=>'Referencia', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('titulo'=>'Debe', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('titulo'=>'Haber', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
);

 

$campos= array("id","cedula","razonsocial");

$pie=array();

$tabla=$grid->getGrid(
        array(
            array('tipo'=>'datagridsimple','cabecera'=>$cabecera,'contenido'=>$campos,'pie'=>$pie,'data'=>$clientes2,'nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'asientoreg')
        ),true
);


 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$tabla.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);




//var_dump($objeto);
?>
