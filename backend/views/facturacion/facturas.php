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

$this->title = "Administración de Facturas";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'N Fact.', 'datareg' => 'nfactura', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Cliente', 'datareg' => 'cliente', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Subtotal', 'datareg' => 'subtotal', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Iva', 'datareg' => 'iva', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Descuento', 'datareg' => 'descuento', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Total', 'datareg' => 'total', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha C.', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'facturasreg')
        )
);

?>
