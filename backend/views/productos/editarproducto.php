<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use backend\components\Grid;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */


$this->title = "Nueva Producto";
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$objeto= new Objetos;
$div= new Bloques;

//var_dump($clientes);

$tipo[1]["id"]=1;$tipo[1]["value"]="PRODUCTOS";
$tipo[2]["id"]=2;$tipo[2]["value"]="SERVICIOS";
//$tipo[2]="SERVICIOS";

 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'codigo', 'id'=>'codigo', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Código: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'codigon', 'id'=>'codigon', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Código N: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'tipo', 'id'=>'tipo', 'valor'=>$tipo, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Tipo: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'codigop', 'id'=>'codigop', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Código Proveedor: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'tipolinea', 'id'=>'tipolinea', 'valor'=>$lineas, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Tipo Cuenta: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'tipounidad', 'id'=>'tipounidad', 'valor'=>$tipounidad, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Unidad: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        //array('tipo'=>'input','subtipo'=>'fecha', 'nombre'=>'fechaemision', 'id'=>'fechaemision', 'valor'=>date("Y-m-d"), 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'calendario','boxbody'=>false,'etiqueta'=>'Fecha emisión: ', 'col'=>'col-12 col-md-5', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'unidades', 'id'=>'unidades', 'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Unidades por bulto: ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'descuento', 'id'=>'descuento', 'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Descuento (%): ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'costofob', 'id'=>'costofob', 'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Costo F.O.B: ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'costou', 'id'=>'costou', 'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Costo Un.: ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'costopm', 'id'=>'costopm', 'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Costo x Mayor.: ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'costodis', 'id'=>'costodis', 'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Costo Dist.: ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'costodis1', 'id'=>'costodis1', 'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Costo Dist. 1: ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'costodis2', 'id'=>'costodis2', 'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Costo Dist. 2: ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'costopvp', 'id'=>'costopvp', 'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Costo PVP: ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'descuentocosto', 'id'=>'descuentocosto', 'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Desc. Costo: ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'caracteristica', 'id'=>'caracteristica', 'valor'=>$caracteristica, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Unidad: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'marca', 'id'=>'marca', 'valor'=>$marca, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Marca: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'color', 'id'=>'color', 'valor'=>$color, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Color: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'unidadsec', 'id'=>'unidadsec', 'valor'=>$tipounidad, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Unidad Facturas: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'unidadesfactura', 'id'=>'unidadesfactura', 'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Unidades por bulto F.: ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        //array('tipo'=>'input','subtipo'=>'textarea', 'nombre'=>'concepto', 'id'=>'concepto', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Concepto: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        //array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cuenta', 'id'=>'cuenta', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cuenta N: ', 'col'=>'col-12 col-md-3', 'adicional'=>''),
        //array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cheque', 'id'=>'cheque', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cheque N: ', 'col'=>'col-12 col-md-3', 'adicional'=>''),
        //array('tipo'=>'input','subtipo'=>'fecha', 'nombre'=>'fechaemision', 'id'=>'fechaemision', 'valor'=>date("Y-m-d"), 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'calendario','boxbody'=>false,'etiqueta'=>'Fecha vencimiento: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
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
        array('tipo'=>'bloquediv','nombre'=>'bloque1','id'=>'bloque1','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$tabla.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'bloque2','id'=>'bloque2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);




//var_dump($objeto);
?>
