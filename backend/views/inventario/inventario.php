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

$this->title = "Administración de Inventario";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;
?>
<div class="row col-12 p-2" >
<?php
echo $botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'ver', 'id' => 'new', 'titulo'=>' Agregar', 'link'=>'nuevoinventario', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));

?>
</div>
<?php


$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Número', 'datareg' => 'numero', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Referencia', 'datareg' => 'referencia', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha', 'datareg' => 'fecha', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Costo', 'datareg' => 'costo', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Total', 'datareg' => 'total', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Dias P.', 'datareg' => 'diasplazo', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Diario', 'datareg' => 'diario', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Total Iva', 'datareg' => 'totaliva', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Total Ice', 'datareg' => 'totalivaice', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Usuario C.', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Fecha C.', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'registros')
        )
);

?>






