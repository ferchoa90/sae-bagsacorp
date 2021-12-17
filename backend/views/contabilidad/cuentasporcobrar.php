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

$this->title = "Administración de Cuentas por cobrar";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Factura', 'datareg' => 'idfactura', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha', 'datareg' => 'fecha', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Tipo', 'datareg' => 'tipo', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Concepto', 'datareg' => 'concepto', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Valor', 'datareg' => 'valor', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Abono', 'datareg' => 'abono', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Saldo', 'datareg' => 'saldo', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Fecha Creación', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'cuentasporcobrarreg')
        )
);

?>
