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
$btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btneviar=array();

$btndevolver=array('tipo'=>'link','nombre'=>'devolver', 'id' => 'devolver', 'titulo'=>'&nbsp;Devolver', 'link'=>'', 'onclick'=>'estado=\'DEVOLVER\';$(\'#modalConfirmacion\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'naranja', 'icono'=>'cancelar','tamanio'=>'pequeño',  'adicional'=>'');
$btnautorizar=array('tipo'=>'link','nombre'=>'autorizar', 'id' => 'autorizar', 'titulo'=>'&nbsp;Autorizar', 'link'=>'', 'onclick'=>'estado=\'AUTORIZAR\';$(\'#modalConfirmacion\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'aceptar','tamanio'=>'pequeño',  'adicional'=>'');
$btnaceptar=array('tipo'=>'link','nombre'=>'aceptado', 'id' => 'aceptado', 'titulo'=>'&nbsp;Aceptar', 'link'=>'', 'onclick'=>'estado=\'ACEPTADO\';$(\'#modalConfirmacion\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'aceptar','tamanio'=>'pequeño',  'adicional'=>'');
$btnenviar=array('tipo'=>'link','nombre'=>'enviar', 'id' => 'enviar', 'titulo'=>'&nbsp;Enviar', 'link'=>'', 'onclick'=>'estado=\'ENVIADO\';$(\'#modalConfirmacion\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'naranja', 'icono'=>'aceptar','tamanio'=>'pequeño',  'adicional'=>'');
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


    default:
        # code...
        break;
}

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
       array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>''),
       $btnenviar,
       $btnaceptar,
       $btnautorizar,
       $btndevolver,
       $btncancelar,


));

$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>Pedido:  </b>'.$pedido->id.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Fecha :  </b>'.$pedido->fechacreacion.'<br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-6 col-md-12"><b>Cliente:</b>&nbsp; '.$pedido->nombres.'</span><br></div>';
$contenido.='<div class="col-6 col-md-9"><b>Dirección:</b>&nbsp; '.$pedido->direccion.'</span><br></div>';
//$contenido.='<div class="col-12 col-md-12"><b>Cliente:</b>&nbsp; '.$pedido->cliente0->razonsocial.'</span><br></div>';
$contenido.='<div class="col-6 col-md-3"><b>Teléfono:</b>&nbsp; '.$pedido->telefono.'</span><br></div>';
$contenido.='<div class="col-6 col-md-4"><b>Subtotal:</b>&nbsp; '.$pedido->subtotal.'</span><br></div>';
$contenido.='<div class="col-6 col-md-5"><b>Iva:</b>&nbsp; '.$pedido->iva.'</span><br></div>';
$contenido.='<div class="col-6 col-md-3"><b>Total:</b>&nbsp; '.$pedido->total.'</span><br></div>';
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

 $tabla='<div class="col-12" style="width: 100%;overflow-x: scroll;">
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
    $tsubtotal+=$value->total;
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

    $contenido.=$tabla;


$form = ActiveForm::begin(['id'=>'frmDatos']);
    echo '<input type="hidden" id="estado" name="estado" /> ';
    echo '<input type="hidden" id="pedido" name="pedido" value="'.$pedido->id.'" /> ';
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'pedido','id'=>'pedido','titulo'=>'Datos del pedido','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'bloc1','id'=>'bloc1','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);
ActiveForm::end();

$modal= New Modal;
$modal= $modal->getModal('okcancel','modalConfirmacion','modalConfirmacion', '', '¿Desea autorizar el pedido?', '', '', '','','cambiarEstado()','$(\'#modalConfirmacion\').modal(\'hide\');','' );
echo $modal;
//var_dump($objeto);
?>
<script>
      var estado='';
        //$("#frmDatos").find(':input').each(function() {
        // var elemento= this;
         //console.log("elemento.id="+ elemento.id + ", elemento.value=" + elemento.value);
        //});
        function cambiarEstado() {
            console.log("Cambiar estado: "+estado);
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
                        //$('#frmDatos')[0].reset();
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
