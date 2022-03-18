<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Navs;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;
use yii\web\View;
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Nuevo pedido';
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['pedidos']];
$this->params['breadcrumbs'][] = $this->title;

$objeto= new Objetos;
$nav= new Navs;
$div= new Bloques;
?>
 
<?php

$urlpost='formeditarpedido';
$botones= new Botones;
//var_dump($pedido->idcliente);
//$contenidotab='';
 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'cliente', 'id'=>'cliente', 'valor'=>$clientes, 'valordefecto'=>$pedido->idcliente, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cliente: ', 'col'=>'col-12 col-md-9', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'orden', 'id'=>'orden', 'valor'=>$pedido->orden, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Órden del pedido','leyenda'=>'Orden de pedido', 'col'=>'col-12 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'archivo', 'nombre'=>'archivo', 'id'=>'archivo', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Escaneado del pedido','leyenda'=>'Archivo de la orden del pedido', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'observacion', 'id'=>'observacion', 'valor'=>$pedido->observacion, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Observación','leyenda'=>'Observación del pedido', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        
        
        
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cantidad1', 'id'=>'cantidad1', 'valor'=>$pedido->pedidosdetalle[0]->cantidad, 'onchange'=>'setSumatoria(this,1)', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'Cantidad','leyenda'=>'Cantidad', 'col'=>'col-2 col-md-2', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'producto1', 'id'=>'producto1', 'valor'=>$productos, 'valordefecto'=>$pedido->pedidosdetalle[0]->idproducto, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Producto', 'col'=>'col-6 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'valor1', 'id'=>'valor1', 'valor'=>$pedido->pedidosdetalle[0]->subtotal, 'onchange'=>' setSumatoria(this,1)', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'P. Unitario','leyenda'=>'0.00', 'col'=>'col-2 col-md-2', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'total1', 'id'=>'total1', 'valor'=>$pedido->pedidosdetalle[0]->total, 'onchange'=>'', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'Total','leyenda'=>'0.00', 'col'=>'col-2 col-md-2', 'adicional'=>' readonly'),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cantidad2', 'id'=>'cantidad2', 'valor'=>@$pedido->pedidosdetalle[1]->cantidad, 'onchange'=>' setSumatoria(this,2)', 'clase'=>'text-right', 'style'=>'', ''=>'lapiz','boxbody'=>false,'etiqueta'=>'','leyenda'=>'Cantidad', 'col'=>'col-2 col-md-2', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'producto2', 'id'=>'producto2', 'valor'=>$productos, 'valordefecto'=>$pedidosdetalle[0]->idproducto, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-6 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'valor2', 'id'=>'valor2', 'valor'=>@$pedido->pedidosdetalle[1]->subtotal, 'onchange'=>' setSumatoria(this,2)', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'','leyenda'=>'0.00', 'col'=>'col-2 col-md-2', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'total2', 'id'=>'total2', 'valor'=>@$pedido->pedidosdetalle[1]->total, 'onchange'=>'', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'','leyenda'=>'0.00', 'col'=>'col-2 col-md-2', 'adicional'=>' readonly'),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cantidad3', 'id'=>'cantidad3', 'valor'=>$pedido->pedidosdetalle[2]->cantidad, 'onchange'=>' setSumatoria(this,3)', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'','leyenda'=>'Cantidad', 'col'=>'col-2 col-md-2', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'producto3', 'id'=>'producto3', 'valor'=>$productos, 'valordefecto'=>$pedidosdetalle[0]->idproducto, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-6 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'valor3', 'id'=>'valor3', 'valor'=>$pedido->pedidosdetalle[2]->subtotal, 'onchange'=>' setSumatoria(this,3)', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'','leyenda'=>'0.00', 'col'=>'col-2 col-md-2', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'total3', 'id'=>'total3', 'valor'=>$pedido->pedidosdetalle[2]->total, 'onchange'=>'', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'','leyenda'=>'0.00', 'col'=>'col-2 col-md-2', 'adicional'=>' readonly'),
        
    ),true
);

$contenidototal=$objeto->getObjetosArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'subtotal', 'id'=>'subtotal', 'valor'=>'', 'onchange'=>'', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'Subtotal','leyenda'=>'0.00', 'col'=>'col-4 col-md-4', 'adicional'=>' readonly'),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'iva', 'id'=>'iva', 'valor'=>'', 'onchange'=>'', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'Iva','leyenda'=>'0.00', 'col'=>'col-4 col-md-4', 'adicional'=>' readonly'),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'totalpedido', 'id'=>'totalpedido', 'valor'=>'', 'onchange'=>'', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'Total','leyenda'=>'0.00', 'col'=>'col-4 col-md-4', 'adicional'=>' readonly'),
        
    ),true
);
 
 $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Actualizar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));
switch ($pedido->estatuspedido) {
    case 'NUEVO':
        $stylestatuscit='badge-primary';
        break;

        case 'CONFIRMADA':
            $stylestatuscit='badge-success';
            break;

    case 'ACEPTADO':
        $stylestatuscit='badge-info';
        break;

    case 'CANCELADA':
        $stylestatuscit='badge-danger';

        break;

    case 'AUTORIZADO':
        $stylestatuscit='badge-secondary';
        break;

    case 'ENVIADO':
        $stylestatuscit='badge-secondary';
        break;

    case 'DEVUELTO':
        $stylestatuscit='badge-warning';
        break;


    default:
        # code...
        break;
}

if ($pedido->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
$contenido2='<div style="line-height:30px;"><b>Estatus Cita:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatuscit.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$pedido->estatuspedido.'</span><br>';
$contenido2.='<b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$pedido->estatus.'</span><br>';
$contenido2.='<hr style="color: #0056b2;">';
$contenido2.='<b>Fecha C.:</b>&nbsp; '.$pedido->fechacreacion.'</span><br>';
$contenido2.='<b>Usuario C.:</b>&nbsp; '.$pedido->usuariocreacion0->username. '</span><br>';
$contenido2.='<hr style="color: #0056b2;">';
$contenido2.='<b>Fecha M.:</b>&nbsp;'.$pedido->usuarioactualizacion0->username. '</span><br>';
$contenido2.='<b>Usuario M.:</b>&nbsp;'.$pedido->fechaact. '</span><br>';
$contenido2.='<hr style="color: #0056b2;">';
$contenido2.='</div>';
$contenido2.='<input type="hidden" id="idpedido" name="idpedido" value="'.$pedido->id.'" /> ';
$contenido2.='<input type="hidden" id="idpedidod1" name="idpedidod1" value="'.$pedido->pedidosdetalle[0]->id.'" /> ';
$contenido2.='<input type="hidden" id="idpedidod2" name="idpedidod2" value="'.@$pedido->pedidosdetalle[1]->id.'" /> ';
$contenido2.='<input type="hidden" id="idpedidod3" name="idpedidod3" value="'.@$pedido->pedidosdetalle[2]->id.'" /> ';

?>

<?php $form = ActiveForm::begin(['id'=>'frmDatos','options' => ['enctype' => 'multipart/form-data']]); ?>
<?php
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'Divform','id'=>'Divform','titulo'=>'Datos del pedido','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$contenidotab.$contenidototal.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'Divform','id'=>'Divform','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);
?>

 
<?php ActiveForm::end(); ?>
<script>
setSumatoria('',1)
function ftt(){
    $('#file').click(); // emulate click on input file
}
function on(){
    var ft = $('#file').val();
    $('#foto').val(ft);
}

function crearEmp(){
    var files = $('#file')[0].files;
    console.log('do something', files);
}


    function setSumatoria(obj,id)
    {
        console.log("Sumatoria: "+obj + " ID: "+id)
        var cantidad; var unitario; var total; var subtotal; var iva; var totalpedido;
        cantidad=$("#cantidad"+id).val();
        unitario=$("#valor"+id).val();
        total=$("#total"+id).val();
        

        if (cantidad && unitario){
            total= parseFloat(cantidad)*parseFloat(unitario);
            $("#total"+id).val(total.toFixed(2));
            $("#cantidad"+id).val(parseFloat(cantidad).toFixed(2));
            $("#valor"+id).val(parseFloat(unitario).toFixed(2));
        }

        subtotal=0;
        for (var i = 1; i < 4; i++) {
            cantidad=$("#cantidad"+i).val();
            unitario=$("#valor"+i).val();
            total=$("#total"+i).val();

            if (cantidad && unitario){
                total= parseFloat(cantidad)*parseFloat(unitario);
                subtotal+= parseFloat(total);
                
            }

            $("#subtotal").val(parseFloat(subtotal).toFixed(2));
            iva= parseFloat(subtotal) * 0.12;
            $("#iva").val(parseFloat(iva).toFixed(2));
            totalpedido=(parseFloat(subtotal)+parseFloat(iva));
            $("#totalpedido").val(parseFloat(totalpedido).toFixed(2));
        }


    }
       $(document).ready(function(){
        //$("#frmDatos").find(':input').each(function() {
        // var elemento= this;
         //console.log("elemento.id="+ elemento.id + ", elemento.value=" + elemento.value);
        //});
        $("#guardar").on('click', function() {
            if (validardatos()==true){
                var form = document.getElementById('frmDatos');
                //var form    = $('#frmDatos');
                var data = new FormData(form);
                var archivo=document.getElementById('archivo').files;
                data.append('files',archivo);
                $.ajax({
                    url: '<?= $urlpost ?>',
                    async: 'false',
                    cache: 'false',
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    //data: form.serialize(),
                    dataType: 'text', //Get back from PHP
                    processData: false, //Don't process the files
                    contentType: false,
                    cache: false,
                    data: data,
                    success: function(response){
                    data=JSON.parse(response);
                    //console.log(response);
                    //console.log(data.success);
                    if ( data.success == true ) {
                        // ============================ Not here, this would be too late
                        notificacion(data.mensaje,data.tipo);
                        //$this.data().isSubmitted = true;
                        $('#frmDatos')[0].reset();
                        return true;
                    }else{
                        notificacion(data.mensaje,data.tipo);
                    }
                }
            });
            }else{
                notificacion("Faltan campos obligatorios","error");
                //e.preventDefault(); // <=================== Here
                return false;
            }
        });
        $('#frmDatos').on('submit', function(e){
            e.preventDefault(); // <=================== Here
            $this = $(this);
            if ($this.data().isSubmitted) {
                return false;
            }
        });
       });
       function validardatos()
       {
           console.log("validardatos");
            if ($('#nombre').val()!=""){
                if ($('#icono').val()!=""){
                    if ($('#link').val()!=""){
                        if ($('#orden').val()!=""){
                            return true;                            
                        }else{
                            $('#orden').focus();
                            return false;
                        }
                    }else{
                        $('#link').focus();
                        return false;
                    }
                }else{
                    $('#icono').focus();
                    return false;
                }
            }else{
                $('#nombre').focus();
                return false;
            }
       }


  </script>
<style>
    input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] { -moz-appearance:textfield; }
</style>

