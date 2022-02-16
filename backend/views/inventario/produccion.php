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

$this->title = "Producción";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;
?>
<div class="row col-12 p-2" >
<?php
echo $botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'ver', 'id' => 'new', 'titulo'=>' Agregar', 'link'=>'nuevoproduccion', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));

?>
</div>
<?php


$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Artículo', 'datareg' => 'referencia', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Concepto', 'datareg' => 'concepto', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Referencia', 'datareg' => 'referencia', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Cuenta', 'datareg' => 'cuenta', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Turno', 'datareg' => 'turno', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha', 'datareg' => 'fecha', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Costo', 'datareg' => 'costoproduccion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Unidades P.', 'datareg' => 'unidadesprod', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Material P.', 'datareg' => 'materialprep', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Desperdicio', 'datareg' => 'desperdicio', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Diferencia', 'datareg' => 'diferencia', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Rango Defecto', 'datareg' => 'rangodefadicional', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Usuario C.', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Fecha C.', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'produccionreg')
        )
);

?>






