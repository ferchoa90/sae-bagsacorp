<?php

use yii\widgets\ActiveForm;
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;

$this->title = "Editar Proveedor";
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;
$hoy=date_create();

 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'checkbox', 'nombre'=>'natural', 'id'=>'natural',
            'valor'=>boolval($proveedor->natural), 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Persona natural: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'identificacion', 'id'=>'identificacion', 
            'valor'=>$proveedor->identificacion, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'R.U.C.: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'cuentacontable', 'id'=>'cuentacontable', 'valor'=>$cuentas,
            'valordefecto'=>$proveedor->cuentacontable, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Cuenta pasivo: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'cuentaanticipo', 'id'=>'cuentaanticipo', 'valor'=>$cuentas,
            'valordefecto'=>$proveedor->cuentaanticipo, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Cuenta anticipo: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'debito', 'id'=>'debito',
            'valor'=>$proveedor->debito, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'valor','boxbody'=>false,
            'etiqueta'=>'Debito: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'credito', 'id'=>'credito',
            'valor'=>$proveedor->credito, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'valor','boxbody'=>false,
            'etiqueta'=>'Credito: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),

        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),

        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombre', 'id'=>'nombre', 
            'valor'=>$proveedor->nombre, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Nombre: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'contacto', 'id'=>'contacto', 
            'valor'=>$proveedor->contacto, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Contacto: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'direccion', 'id'=>'direccion', 
            'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Direccion: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),    
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'correo', 'id'=>'correo', 
            'valor'=>$proveedor->correo, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Email: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'notas', 'id'=>'notas', 
            'valor'=>$proveedor->notas, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Notas: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'telefono', 'id'=>'telefono', 
            'valor'=>$proveedor->telefono, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Telefono: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'fax', 'id'=>'fax', 
            'valor'=>$proveedor->fax, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Fax: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        
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
            datos.push({name: 'id', value: <?php echo $proveedor->id; ?>});
            datos.push({name: 'natural', value: $('#natural')[0].checked});
            $.ajax({
                url: 'guardarproveedor',
                async: 'false',
                cache: 'false',
                type: 'POST',
                data: datos,
                success: function(response) {
                    data=JSON.parse(response);
                    notificacion(data.message, data.tipo);
                    if (data.success) {
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
    if ($('#identificacion').val() <= 0) {
        error += (error.length > 0 ? ", " : "") + "RUC";
    }
    if ($('#cuentacontable').val() <= 0) {
        error += (error.length > 0 ? ", " : "") + "Cuenta de pasivo";
    }
    return error;
}
</script>