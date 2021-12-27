<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Edición de  Línea";
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'Nombre', 'id'=>'cuenta', 'valor'=>$model->nombre, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre: ', 'col'=>'col-12', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'etiqueta'=>'Cuenta Inventario', 'id'=>'cuentainv', 'valor'=>$cuentas, 'valordefecto'=>$model->cuentainv, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'nombre'=>'cuentainv', 'col'=>'col-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'cajatexto', 'etiqueta'=>'Cuenta ventas', 'id'=>'cuentaventas', 'valor'=>$cuentas, 'valordefecto'=>$model->cuentaventas, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'nombre'=>'cuentaventas', 'col'=>'col-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'cajatexto', 'etiqueta'=>'Cuenta Ventas Des.', 'id'=>'cuentaventasdes', 'valor'=>$cuentas, 'valordefecto'=>$model->cuentaventasdes, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'nombre'=>'cuentaventasdes', 'col'=>'col-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'cajatexto', 'etiqueta'=>'Cuenta Ventas Dev.', 'id'=>'cuentaventasdev', 'valor'=>$cuentas, 'valordefecto'=>$model->cuentaventasdev, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'nombre'=>'cuentaventasdev', 'col'=>'col-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'cajatexto', 'etiqueta'=>'Cuenta Costos', 'id'=>'cuentacostos', 'valor'=>$cuentas, 'valordefecto'=>$model->cuentacostos, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'nombre'=>'cuentacostos', 'col'=>'col-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'cajatexto', 'etiqueta'=>'Cuenta Costos Des.', 'id'=>'cuentacostosdes', 'valor'=>$cuentas, 'valordefecto'=>$model->cuentacostosdes, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'nombre'=>'cuentacostosdes', 'col'=>'col-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'cajatexto', 'etiqueta'=>'Cuenta Costos Dev.', 'id'=>'cuentacostosdev', 'valor'=>$cuentas, 'valordefecto'=>$model->cuentacostosdev, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'nombre'=>'cuentacostosdev', 'col'=>'col-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'cajatexto', 'etiqueta'=>'Cuenta Entrada Inv.', 'id'=>'cuentaentradainv', 'valor'=>$cuentas, 'valordefecto'=>$model->cuentaentradainv, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'nombre'=>'cuentaentradainv', 'col'=>'col-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'cajatexto', 'etiqueta'=>'Cuenta Salida Inv.', 'id'=>'cuentasalidainv', 'valor'=>$cuentas, 'valordefecto'=>$model->cuentasalidainv, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'nombre'=>'cuentasalidainv', 'col'=>'col-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'cajatexto', 'etiqueta'=>'Cuenta Salida Mue.', 'id'=>'cuentasalidamue', 'valor'=>$cuentas, 'valordefecto'=>$model->cuentasalidamue, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'nombre'=>'cuentasalidamue', 'col'=>'col-6', 'adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
    ),true
);
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-9 col-xs-12 ','','','','');
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-3 col-xs-12 ','','','','');
 //echo $contenido;
 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Actualizar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));


$contenido2='<div style="line-height:25px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; '.$model->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Usuario C.:</b>&nbsp;&nbsp;'.$model->usuariocreacion0->username.'<br>';
 $contenido2.='<hr style="color: #0056b2;">';
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
