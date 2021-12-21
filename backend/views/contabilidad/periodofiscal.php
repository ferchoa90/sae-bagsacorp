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

$this->title = "Administración de Periodos Fiscales";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Descripcion', 'datareg' => 'descripcion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Año Inicio', 'datareg' => 'anioinicio', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Año fin', 'datareg' => 'aniofin', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Usuario C.', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha Creación', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'periodofiscalreg')
        )
);

?>
