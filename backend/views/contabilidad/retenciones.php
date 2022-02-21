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

$this->title = "Retenciones";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Serie', 'datareg' => 'serie', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Número', 'datareg' => 'comprobante', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha', 'datareg' => 'fecha', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Proveedor', 'datareg' => 'proveedor', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'V. retenido', 'datareg' => 'valorretenido', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Base Imp.', 'datareg' => 'baseimponible', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Identificación', 'datareg' => 'identificacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Usuario c.', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha Creación', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'retencionesreg')
        )
);

?>
