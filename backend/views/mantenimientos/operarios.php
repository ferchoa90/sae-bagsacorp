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

$this->title = "Operarios";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;
?>
<div class="row col-12 p-2" >
<?php
echo $botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'ver', 'id' => 'new', 'titulo'=>' Agregar', 'link'=>'', 'onclick'=>'nuevoOperario();' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));

?>
</div>
<?php


$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Nombres', 'datareg' => 'nombres', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Usuario C.', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Fecha C.', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'operariosreg')
        )
);

?>

<script>
function nuevoOperario() {
    let nombre = prompt('Nombre del operario');
    if (nombre != null) {
        guardarOperario({
            id: 0,
            nombre: nombre
        });
    } else {
        notificacion("El nombre es un campo requerido","error");
    }
}

function editarOperario(pid, pnombre) {
    let nombre = prompt('Nombre del operario', pnombre);
    if (nombre != null) {
        guardarOperario({
            id: pid,
            nombre: nombre
        })
    } else {
        notificacion("El nombre es un campo requerido","error");
    }
}

function guardarOperario(operario) {
    $.ajax({
        url: 'guardaroperario',
        async: 'false',
        cache: 'false',
        type: 'POST',
        data: operario,
        success: function(response) {
            data=JSON.parse(response);
            notificacion(data.message, data.tipo);
            if (data.success) {
                location.reload();
                return true;
            }
        },
        error: function(data) {
            console.log("Error al guardar operario:");
            console.log(data);
            notificacion("Se produjo un error al intentar guardar");
        },
    });
}
</script>