<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Modal;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = "Ver Pedido";
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['pedidos']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

$urlpost='gestionarpedido';
$btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btnenviar=array();

$btndevolver=array('tipo'=>'link','nombre'=>'devolver', 'id' => 'devolver', 'titulo'=>'&nbsp;Devolver', 'link'=>'', 'onclick'=>'estado=\'DEVOLVER\';$(\'#modalDevolver\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'naranja', 'icono'=>'cancelar','tamanio'=>'pequeño',  'adicional'=>'');
$btnautorizar=array('tipo'=>'link','nombre'=>'autorizar', 'id' => 'autorizar', 'titulo'=>'&nbsp;Autorizar', 'link'=>'', 'onclick'=>'estado=\'AUTORIZAR\';$(\'#modalConfirmacion\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'aceptar','tamanio'=>'pequeño',  'adicional'=>'');
$btnaceptar=array('tipo'=>'link','nombre'=>'aceptado', 'id' => 'aceptado', 'titulo'=>'&nbsp;Aceptar', 'link'=>'', 'onclick'=>'estado=\'ACEPTADO\';$(\'#modalAceptar\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'aceptar','tamanio'=>'pequeño',  'adicional'=>'');
$btnenviar=array('tipo'=>'link','nombre'=>'enviar', 'id' => 'enviar', 'titulo'=>'&nbsp;Enviar', 'link'=>'', 'onclick'=>'estado=\'ENVIADO\';$(\'#modalEnviar\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'naranja', 'icono'=>'aceptar','tamanio'=>'pequeño',  'adicional'=>'');
$btncancelar=array('tipo'=>'link','nombre'=>'cancelar', 'id' => 'cancelar', 'titulo'=>'&nbsp;Cancelar', 'link'=>'', 'onclick'=>'estado=\'CANCELADO\';$(\'#modalConfirmacion\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'pequeño',  'adicional'=>'');

switch ($pedido->estatuspedido) {
    case 'NUEVO':
        $stylestatuscit='badge-primary';
        $btnautorizar=array();$btndevolver=array();$btnaceptar=array();
        break;

        case 'CONFIRMADA':
            $stylestatuscit='badge-success';
             $btncancelar=array();$btnenatencion=array();$btnconfirmar=array();
            break;

    case 'ACEPTADO':
        $stylestatuscit='badge-info';
        $btnenatencion=array();$btncancelar=array();$btnaceptar=array();$btnenviar=array();
        $btndevolver=array('tipo'=>'link','nombre'=>'anular', 'id' => 'anular', 'titulo'=>'&nbsp;Anular', 'link'=>'', 'onclick'=>'estado=\'ANULAR\';$(\'#modalAnular\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'cancelar','tamanio'=>'pequeño',  'adicional'=>'');
        break;

    case 'CANCELADA':
        $stylestatuscit='badge-danger';
        $btnatendido=array();$btncancelar=array();

        break;

    case 'AUTORIZADO':
        $stylestatuscit='badge-secondary';
        $btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btnenviar=array();
        break;

    case 'ENVIADO':
        $stylestatuscit='badge-secondary';
        $btnautorizar=array();$btncancelar=array();$btnenviar=array();
        break;

    case 'DEVUELTO':
        $stylestatuscit='badge-warning';
        $btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btnenviar=array();
        break;

        case 'ANULADO':
            $stylestatuscit='badge-danger';
            $btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btnenviar=array();
            break;

    case 'FACTURADO TOTAL':
        $stylestatuscit='badge-secondary';
        $btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btnenviar=array();
        break;

    case 'FACTURADO PARCIAL':
        $stylestatuscit='badge-warning';
        $btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btnenviar=array();
        break;


    default:
        # code...
        break;
}

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
       array('tipo'=>'link','nombre'=>'regresar', 'id' => 'regresar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>''),
       $btnenviar,
       $btnaceptar,
       $btnautorizar,
       $btndevolver,
       $btncancelar,


));

$botonarchivo=$botones->getBotongridArray(
    array(
       array('tipo'=>'link','nombre'=>'pdf', 'id' => 'pdf', 'titulo'=>'&nbsp;Ver', 'link'=>'/backend/web/images/pedidos/'.$pedido->imagen, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'naranja', 'icono'=>'archivo','tamanio'=>'pequeño','target'=>'blank',  'adicional'=>''),
));

$contenido='<div style="line-height:30px;" class="row"><div class="col-4 col-md-4"><b>Pedido:  </b>'.$pedido->id.'<br></div>';
$contenido.='<div class="col-4 col-md-4"><b>Orden de C. Cliente:  </b>'.$pedido->orden.'<br></div>';
$contenido.='<div class="col-4 col-md-4"><b>Fecha:  </b>'.$pedido->fechacreacion.'<br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-6 col-md-12"><b>Cliente:</b>&nbsp; '.$pedido->nombres.'</span><br></div>';
$contenido.='<div class="col-6 col-md-9"><b>Dirección:</b>&nbsp; '.$pedido->direccion.'</span><br></div>';
//$contenido.='<div class="col-12 col-md-12"><b>Cliente:</b>&nbsp; '.$pedido->cliente0->razonsocial.'</span><br></div>';
$contenido.='<div class="col-6 col-md-3"><b>Teléfono:</b>&nbsp; '.$pedido->telefono.'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Subtotal:</b>&nbsp; '.$pedido->subtotal.'</span><br></div>';
$contenido.='<div class="col-6 col-md-5"><b>Iva:</b>&nbsp; '.$pedido->iva.'</span><br></div>';
$contenido.='<div class="col-6 col-md-3"><b>Total:</b>&nbsp; '.$pedido->total.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>Observación:</b>&nbsp; '.$pedido->observacion.'</span><br></div>';
$contenido.='<div class="col-6 col-md-3 mb-3"><b>Documento: </b>&nbsp; '.$botonarchivo.'</span><br></div>';
//$contenido.='<div class="col-6 col-md-3 mb-3"><b>Cartera: </b>&nbsp; <span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp;&nbsp;AL DÍA</span> </span><br></div>';
 $contenido.='<div class="col-6 col-md-3 mb-3"><b>Cartera: </b>&nbsp; <span class="badge badge-danger"><i class="fa fa-circle"></i>&nbsp;&nbsp;<span style="font-size:14px">VENCIDA (40 DÍAS)</span></span> </span><br></div>';
//$contenido.='<div class="col-12 col-md-12"><b>Notas:</b>&nbsp; '.$pedido->notas.'</span><br></div>';
//$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';



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

 $tabla='<div class="col-12 mt-2" style="width: 100%;overflow-x: scroll;">
 <table class="table table-striped">
 <thead>
   <tr>
     <th scope="col">Cant.</th>
     <th scope="col">Item</th>
     <th scope="col" class="text-center">Valor</th>

     <th scope="col" class="text-center">Total</th>

   </tr>
 </thead>
 <tbody>';
$cont=0; $cont2=1; $tdescuento=0; $tiva=0; $tcantidad=0;$tsubtotal=0;

 foreach ($pedido->pedidosdetalle as $key => $value) {
    $scope= ($con==1)? $scope='scope="row"' : $scope='';
    $tcantidad+=$value->cantidad;
    $tsubtotal+=($value->total/1.12);
    $tiva+=($value->iva*$value->cantidad);
    $tdescuento+=$value->descuento;
   // if ($value->debito==0){ $debe=$value->valor; $sumdebe+=$value->valor; $haber=0; }else{  $haber=$value->valor;  $sumhaber+=$value->valor; $debe=0;     }
    $tabla.=' <tr><td '.$scope.'>'.number_format($value->cantidad,2).'</td><td>'.$value->nombreprod.'</td><td class="text-right">'.number_format($value->subtotal,2).'</td>';
    $tabla.='<td class="text-right">'.number_format($value->cantidad*$value->subtotal,2).'</td></tr>';
    $cont++; $cont2++;
    ($con==2)? $cont=0 : $cont=$cont;
 }
$tabla.='</tbody></table><table class="table table"> <tbody><tr><td class="text-center"><b>Items: </b>'.$cont.'</td><td class="text-center"><b>T. Cant.: </b>'.number_format($tcantidad,3).'</td>';
$tabla.='<td class="text-center"><b>Subtotal: </b>'.number_format($tsubtotal,2).'</td><td class="text-center"><b>Descuento: </b>'.number_format($tdescuento,2).'</td><td class="text-center"><b>T. Iva: </b>'.number_format($tiva,2).'</td><td class="text-center"><b>Total: </b>'.number_format($tsubtotal+$tiva,2).'</td> </tr>';

   $tabla.='</tbody></table></div>';
 //  var_dump($pedido->pedidosmensajes);
 if ($pedido->pedidosmensajes){
 $mensajes='
 <div class="mt-3">
    <label> Comentarios </label>
    <div class="chat-container p-3">
        <ul class="chat-box chatContainerScroll pr-5">';
        $cont=0;
    foreach ($pedido->pedidosmensajes as $key => $value) {
        $cont++;
        if ($cont==1)
        {
        $mensajes.='
        <div class="col-12 chat-left chat-avatar" style="text-align: left;">

        </div>
        <li class="chat-left">
        <div class="chat-avatar" style="text-align: center;">
                    <img src="/backend/web/images/default.png" alt="Retail Admin">
                    <div class="chat-name mt-2"><b>'.$value->idusuarioorg0->nombres.' '.$value->idusuarioorg0->apellidos.'</b></div>
                </div>
                <div class="chat-text">'.$value->mensaje.'
                <div class="chat-hour p-3">'.$value->fechacreacion.' &nbsp;<span class="fa fa-check-circle"></span></div>
                </div>
            </li>';
        }
        if ($cont==2){
            $mensajes.='
            <div class="col-12 chat-right chat-avatar" style="text-align: right;">

        </div>
            <li class="chat-right">

                <div class="chat-text">'.$value->mensaje.'
                <div class="chat-hour p-3">'.$value->fechacreacion.' &nbsp;<span class="fa fa-check-circle"></span></div>
                </div>
                <div class="chat-avatar" style="text-align: center;">
                    <img src="/backend/web/images/default.png" alt="Retail Admin">
                    <div class="chat-name mt-2"><b>'.$value->idusuarioorg0->nombres.' '.$value->idusuarioorg0->apellidos.'</b></div>
                </div>
            </li>';
            $cont=0;
        }
    }



        $mensajes.='</ul>
    </div>
</div>

 ';
 }
    $contenido.=$tabla.$mensajes;


$form = ActiveForm::begin(['id'=>'frmDatos']);
    echo '<input type="hidden" id="estado" name="estado" /> ';
    echo '<input type="hidden" id="pedido" name="pedido" value="'.$pedido->id.'" /> ';
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'pedido','id'=>'pedido','titulo'=>'Datos del pedido','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'bloc1','id'=>'bloc1','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

$modal= New Modal;
$estatusmen="cambiar el estatus";

$modalAutorizar= $modal->getModal('okcancel','modalConfirmacion','modalConfirmacion', '', '¿Desea autorizar el pedido?', '', '', '','','cambiarEstado(false)','$(\'#modalConfirmacion\').modal(\'hide\');','' );
$modalAceptar= $modal->getModal('okcancel','modalAceptar','modalAceptar', '', '¿Desea aceptar el pedido, y enviarlo para su autorización final?', '', '', '','','cambiarEstado(false)','$(\'#modalAceptar\').modal(\'hide\');','' );
$modalEnviar= $modal->getModal('okcancel','modalEnviar','modalEnviar', '', '¿Desea enviar el pedido, para su aprobación?', '', '', '','','cambiarEstado(false)','$(\'#modalEnviar\').modal(\'hide\');','' );
$modalAnular= $modal->getModal('okcancelinput','modalAnular','modalAnular', '', '¿Desea anular el pedido, el mismo no podrá ser nuevamente activado?', '', '', '','width: 80%;','cambiarEstado(true)','$(\'#modalAnular\').modal(\'hide\');','' );
$modalDevolver= $modal->getModal('okcancelinput','modalDevolver','modalDevolver', '', '¿Desea devolver el pedido?', '', '', '','width: 80%;','cambiarEstado(true)','$(\'#modalDevolver\').modal(\'hide\');','' );
echo $modalAutorizar;
echo $modalEnviar;
echo $modalAceptar;
echo $modalAnular;
if ($pedido->estatuspedido=="ENVIADO"){echo $modalDevolver;}

ActiveForm::end();


//var_dump($objeto);
?>


<script>
      var estado='';
        //$("#frmDatos").find(':input').each(function() {
        // var elemento= this;
         //console.log("elemento.id="+ elemento.id + ", elemento.value=" + elemento.value);
        //});
        function cambiarEstado(mensaje) {
            //console.log("Cambiar estado: "+estado);

            $('#estado').val(estado);
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
                        location.reload();
                        return true;
                    }else{
                        notificacion(data.mensaje,data.tipo);
                    }
                }
            });

        }
        $('#frmDatos').on('submit', function(e){
            e.preventDefault(); // <=================== Here
            $this = $(this);
            if ($this.data().isSubmitted) {
                return false;
            }
        });
  </script>
<style>
    input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] { -moz-appearance:textfield; }
</style>
