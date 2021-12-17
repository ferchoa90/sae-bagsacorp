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
    array(array('tipo'=>'link','nombre'=>'ver', 'id' => 'new', 'titulo'=>' Agregar', 'link'=>'agregarstockex', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));

?>
</div>
<?php


$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Título', 'datareg' => 'titulo', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Imagen', 'datareg' => 'imagen', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Stock', 'datareg' => 'stock', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'PVP Final', 'datareg' => 'preciovp', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'PVP Men', 'datareg' => 'preciov2', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Código Art.', 'datareg' => 'codigobarras', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Tipo', 'datareg' => 'tipod', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Presentacion', 'datareg' => 'presentacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Color', 'datareg' => 'color', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Calidad', 'datareg' => 'calidad', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Usuario C.', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'registros')
        )
);

?>






