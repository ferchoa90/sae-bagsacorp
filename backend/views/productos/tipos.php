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

$this->title = "Administración de Tipos";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Nombres', 'datareg' => 'nombre', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Descripcion', 'datareg' => 'descripcion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Cta Inventario', 'datareg' => 'cuentainv', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Cta. Ventas', 'datareg' => 'cuentaventas', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Cta. Ventas Des.', 'datareg' => 'cuentaventasdes', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Cta. Ventas Dev.', 'datareg' => 'cuentaventasdev', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Cta. Costos', 'datareg' => 'cuentacostos', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Cta. Costos Des.', 'datareg' => 'cuentacostosdes', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Cta. Costos Dev.', 'datareg' => 'cuentacostosdev', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Cta. Salida Inv.', 'datareg' => 'cuentasalidainv', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Cta. Salida Mues.', 'datareg' => 'cuentasalidamue', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Cta. Entrada Inv.', 'datareg' => 'cuentaentradainv', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Usuario C.', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'tiposreg')
        )
);

?>