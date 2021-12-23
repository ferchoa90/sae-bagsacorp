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

$this->title = "Administración de Cuentas";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;


?>

<div class="row col-12 p-2" >
<?php
echo $botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'ver', 'id' => 'new', 'titulo'=>' Agregar', 'link'=>'nuevacuenta', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));
?>
</div>
<?php

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Código', 'datareg' => 'codigoant', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Parent', 'datareg' => 'parent', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Cod. New', 'datareg' => 'codigo', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Nombres', 'datareg' => 'nombre', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Saldo', 'datareg' => 'saldo', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Cheque', 'datareg' => 'cheque', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Fecha Hora', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'cuentasreg')
        )
);

?>
