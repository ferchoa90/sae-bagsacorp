<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Estado de cuenta cliente";
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;
//var_dump($clientes);
 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'cliente', 'id'=>'cliente', 'valor'=>$clientes, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cliente: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'fecha', 'nombre'=>'desde', 'id'=>'desde', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Desde: ', 'col'=>'col-4 col-md-4', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'fecha', 'nombre'=>'hasta', 'id'=>'hasta', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Hasta: ', 'col'=>'col-4 col-md-4', 'adicional'=>''),
        array('tipo'=>'boton','nombre'=>'filtrar', 'id' => 'filtrar', 'titulo'=>'&nbsp;Filtrar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'negro', 'icono'=>'filtro','tamanio'=>'pequeño',  'adicional'=>'')
    ),true
);
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-9 col-xs-12 ','','','','');
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-3 col-xs-12 ','','','','');
 //echo $contenido;
 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        //array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')
));


 $contenido2='<div style="line-height:25px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ACTIVO</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';








 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'','clase'=>'col-md-12 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$table.$botonC),
       // array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
