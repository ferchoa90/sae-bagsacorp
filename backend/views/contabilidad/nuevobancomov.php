<?php

use yii\widgets\ActiveForm;
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;

$this->title = "Nuevo Banco Mov";
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;
$hoy=date_create();

 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'referencia', 'id'=>'referencia', 
            'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Referencia: ', 'col'=>'col-12 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'fecha', 'nombre'=>'fecha', 'id'=>'fecha', 
            'valor'=>date_format($hoy, "Y-m-d"), 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'calendario','boxbody'=>false,
            'etiqueta'=>'Fecha: ', 'col'=>'col-12 col-md-3', 'adicional'=>' readonly'),    
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'diario', 'id'=>'diario', 
            'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Diario: ', 'col'=>'col-12 col-md-3', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'tipo', 'id'=>'tipo', 'valor'=>$tiposPago, 
            'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Tipo Mov: ', 'col'=>'col-12 col-md-3', 'adicional'=>''),    
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'cuenta', 'id'=>'cuenta', 'valor'=>$cuentas, 
            'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Cuenta: ', 'col'=>'col-12 col-md-8', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'numeroretencion', 'id'=>'numeroretencion', 
            'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'No. Retencion: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),

        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),                    

        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'beneficiario', 'id'=>'beneficiario', 
            'valor'=> '', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Beneficiario: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'concepto', 'id'=>'concepto', 
            'valor'=> '', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Concepto: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'valor', 'id'=>'valor', 
            'valor'=>'0.00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'valor','boxbody'=>false,
            'etiqueta'=>'Valor: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'tipopago', 'id'=>'tipopago', 'valor'=>$tiposPagoBanco, 
            'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,
            'etiqueta'=>'Tipo de pago: ', 'col'=>'col-12 col-md-8', 'adicional'=>''),
    ),true
);
 
$botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$contenido2='<div style="line-height:25px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ACTIVO</span><br>';
$contenido2.='<hr style="color: #0056b2;">';
$contenido2.='</div>';

$form = ActiveForm::begin(['id'=>'frmDatos']);
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
    inicializarCombos();
    $("#guardar").on('click', function() {
        let errors = validardatos();
        if (errors.length == 0) {
            var form = $('#frmDatos');
            $.ajax({
                url: 'guardarbancomov',
                async: 'false',
                cache: 'false',
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    data=JSON.parse(response);
                    notificacion(data.message, data.tipo);
                    if (data.success) {
                        $('#frmDatos')[0].reset();
                        inicializarCombos();
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
    if ($('#fecha').val() == "") {
        error += "fecha";        
    }
    if ($('#cuenta').val() == "") {
        error += (error.length > 0 ? ", " : "") + "cuenta";
    }
    if ($('#concepto').val() == "") {
        error += (error.length > 0 ? ", " : "") + "concepto";
    }
    if ($('#valor').val() <= 0) {
        error += (error.length > 0 ? ", " : "") + "valor";
    }
    if ($('#tipopago').val() <= 0) {
        error += (error.length > 0 ? ", " : "") + "tipo de pago";
    }
    if ($('#tipo').val() <= 0) {
        error += (error.length > 0 ? ", " : "") + "tipo de mov";
    }
    return error;
}
function inicializarCombos() {
    $('#tipo').val(-1);
    $('#tipopago').val(-1);
    $('#cuenta').val(-1);
}
</script>