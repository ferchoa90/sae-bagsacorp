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

$urlpost='formmenuadmin';

$objeto= new Objetos;
$nav= new Navs;
$div= new Bloques;

$urlpost='formnuevopedido';
$botones= new Botones;
//var_dump($clientes);
//$contenidotab='';
 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'cliente', 'id'=>'cliente', 'valor'=>$clientes, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cliente: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'observacion', 'id'=>'observacion', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Observación','leyenda'=>'Observación del pedido', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        
        
        
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cantidad1', 'id'=>'cantidad1', 'valor'=>'', 'onchange'=>' setSumatoria(this,1)', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'Cantidad','leyenda'=>'Cantidad', 'col'=>'col-2 col-md-2', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'producto1', 'id'=>'producto1', 'valor'=>$productos, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Producto', 'col'=>'col-6 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'valor1', 'id'=>'valor1', 'valor'=>'', 'onchange'=>' setSumatoria(this,1)', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'P. Unitario','leyenda'=>'0.00', 'col'=>'col-2 col-md-2', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'total1', 'id'=>'total1', 'valor'=>'', 'onchange'=>'', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'Total','leyenda'=>'0.00', 'col'=>'col-2 col-md-2', 'adicional'=>' readonly'),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cantidad2', 'id'=>'cantidad2', 'valor'=>'', 'onchange'=>' setSumatoria(this,2)', 'clase'=>'text-right', 'style'=>'', ''=>'lapiz','boxbody'=>false,'etiqueta'=>'','leyenda'=>'Cantidad', 'col'=>'col-2 col-md-2', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'producto2', 'id'=>'producto2', 'valor'=>$productos, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-6 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'valor2', 'id'=>'valor2', 'valor'=>'', 'onchange'=>' setSumatoria(this,2)', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'','leyenda'=>'0.00', 'col'=>'col-2 col-md-2', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'total2', 'id'=>'total2', 'valor'=>'', 'onchange'=>'', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'','leyenda'=>'0.00', 'col'=>'col-2 col-md-2', 'adicional'=>' readonly'),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cantidad3', 'id'=>'cantidad3', 'valor'=>'', 'onchange'=>' setSumatoria(this,3)', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'','leyenda'=>'Cantidad', 'col'=>'col-2 col-md-2', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'producto3', 'id'=>'producto3', 'valor'=>$productos, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-6 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'valor3', 'id'=>'valor3', 'valor'=>'', 'onchange'=>' setSumatoria(this,3)', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'','leyenda'=>'0.00', 'col'=>'col-2 col-md-2', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'total3', 'id'=>'total3', 'valor'=>'', 'onchange'=>'', 'clase'=>'text-right', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'','leyenda'=>'0.00', 'col'=>'col-2 col-md-2', 'adicional'=>' readonly'),
        
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
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-9 col-xs-12 ','','','','');
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-3 col-xs-12 ','','','','');
 //echo $contenido;
 $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));


 $contenido2='<div style="line-height:25px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ACTIVO</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';
?>

<?php $form = ActiveForm::begin(['id'=>'frmDatos']); ?>
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
                var form    = $('#frmDatos');
                $.ajax({
                    url: '<?= $urlpost ?>',
                    async: 'false',
                    cache: 'false',
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response){
                    data=JSON.parse(response);
                    console.log(response);
                    console.log(data.success);
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