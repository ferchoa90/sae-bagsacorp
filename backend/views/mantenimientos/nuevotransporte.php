<?php

use yii\widgets\ActiveForm;
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;

$this->title = "Nuevo Transporte";
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;
$hoy=date_create();

$contenido=$objeto->getObjetosArray(
    array(
      array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombre', 'id'=>'nombre', 
          'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
          'etiqueta'=>'Nombre: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
      array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'contacto', 'id'=>'contacto', 
          'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
          'etiqueta'=>'Contacto: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
      array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'direccion', 'id'=>'direccion', 
          'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
          'etiqueta'=>'Direccion: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
      array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'observaciones', 'id'=>'observaciones', 
          'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
          'etiqueta'=>'Observaciones: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
      array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'telefonos', 'id'=>'telefonos', 
          'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
          'etiqueta'=>'Telefono: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
      array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'ruc', 'id'=>'ruc', 
          'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
          'etiqueta'=>'R.U.C.: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
      array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'placa', 'id'=>'placa', 
          'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
          'etiqueta'=>'Placa: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
    ),true
);
 
$botones = new Botones; 
$botonC = $botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$contenido2.='<div style="line-height:25px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ACTIVO</span><br>';
$contenido2.='<hr style="color: #0056b2;">';
$contenido2.='</div>';

$form = 
ActiveForm::begin(['id'=>'frmDatos']);
    echo $div->getBloqueArray(
        array(
            array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
            array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
        )
    );
ActiveForm::end();
?>

<script>
$(document).ready(function() {
    $("#guardar").on('click', function() {
        let errors = validardatos();
        if (errors.length == 0) {
            var datos = $('#frmDatos').serializeArray();
            $.ajax({
                url: 'guardartransporte',
                async: 'false',
                cache: 'false',
                type: 'POST',
                data: datos,
                success: function(response) {
                    data=JSON.parse(response);
                    notificacion(data.message, data.tipo);
                    if (data.success) {
                        $('#frmDatos')[0].reset();
                        return true;
                    }
                },
                error: function(data) {
                    console.log("Error al guardar:");
                    console.log(data);
                    notificacion("Se produjo un error al intentar guardar");
                },
            });
        } else {
            notificacion("Estos campos son requeridos: " + errors,"error");
            return false;
        }
    });

    $('#frmDatos').on('submit', function(e) {
        e.preventDefault();
        _this = $(this);
        if (_this.data().isSubmitted) {
            return false;
        }
    });
});

function validardatos() {
    let error = "";
    if ($('#nombre').val() == "") {
        error += (error.length > 0 ? ", " : "") + "nombre";
    }
    return error;
}
</script>