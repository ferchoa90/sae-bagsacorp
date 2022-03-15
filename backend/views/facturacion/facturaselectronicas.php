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

$botones= new Botones;
$this->title = "Facturas Electrónicas";
?>
<div class="row col-12 p-2" >
<?php
echo $botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'ver', 'id' => 'new', 'titulo'=>' Agregar', 'link'=>'nuevafactura', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));

?>
</div>
<?php
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;


$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'N Fact.', 'datareg' => 'nfactura', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Cliente', 'datareg' => 'cliente', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Subtotal', 'datareg' => 'subtotal', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Iva', 'datareg' => 'iva', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Descuento', 'datareg' => 'descuento', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Total', 'datareg' => 'total', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Clave Acceso', 'datareg' => 'claveacceso', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    //array('columna'=>'Autorizacion', 'datareg' => 'autorizacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha C.', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Env. L.', 'datareg' => 'enviadoenlinea', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Env. SRI', 'datareg' => 'enviadosri', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'facturaselectronicasreg')
        )
);

?>
