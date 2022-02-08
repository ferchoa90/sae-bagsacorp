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

$this->title = "Administración de Caja";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;


?>

<div class="row col-12 p-2" >
<?php
echo $botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'ver', 'id' => 'new', 'titulo'=>' Agregar', 'link'=>'nuevacaja', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));
?>
</div>
<?php

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Referencias', 'datareg' => 'referencia', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha', 'datareg' => 'fecha', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Valor', 'datareg' => 'valor', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Proveedor', 'datareg' => 'proveedor', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Beneficiario', 'datareg' => 'beneficiario', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Tipo pago', 'datareg' => 'tipopago', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Concepto', 'datareg' => 'concepto', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Cuenta', 'datareg' => 'cuenta', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Comprobante', 'datareg' => 'comprobante', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Diario', 'datareg' => 'diario', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Usuario Creación', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Fecha Hora', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'cajareg')
        )
);

?>
