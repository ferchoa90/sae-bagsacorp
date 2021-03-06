<?php
use backend\components\Objetos;
use backend\components\Botones;
use backend\components\Bloques;
use backend\components\Grid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use backend\assets\AppAsset;
/* @var $this yii\web\View */

$this->title = "Pedidos";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;


?>

<div class="row col-12 p-2" >
<?php
echo $botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'ver', 'id' => 'new', 'titulo'=>' Agregar', 'link'=>'nuevopedido', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));
?>
</div>
<?php

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Nombres', 'datareg' => 'nombres', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Dirección', 'datareg' => 'direccion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Teléfono', 'datareg' => 'telefono', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Subtotal', 'datareg' => 'subtotal', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Iva', 'datareg' => 'iva', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Total', 'datareg' => 'total', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'U. creación', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Fecha creación', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus Pedido.', 'datareg' => 'estatuspedido', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus Prod.', 'datareg' => 'estatusproduccion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus Gen.', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'pedidosreg')
        )
);

?>
