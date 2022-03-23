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

$urlpost='gestionarpedidoprod';
$btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btngenerar=array();

$btngenerar=array('tipo'=>'link','nombre'=>'generar', 'id' => 'generar', 'titulo'=>'&nbsp;Gen. Orden P.', 'link'=>'', 'onclick'=>'estado=\'GENERAR\';$(\'#modalGenerar\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'plomo', 'icono'=>'aceptar','tamanio'=>'pequeño',  'adicional'=>'');
$btndevolver=array('tipo'=>'link','nombre'=>'devolver', 'id' => 'devolver', 'titulo'=>'&nbsp;Devolver', 'link'=>'', 'onclick'=>'estado=\'DEVOLVER\';$(\'#modalDevolver\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'naranja', 'icono'=>'cancelar','tamanio'=>'pequeño',  'adicional'=>'');
$btnautorizar=array('tipo'=>'link','nombre'=>'autorizar', 'id' => 'autorizar', 'titulo'=>'&nbsp;Autorizar', 'link'=>'', 'onclick'=>'estado=\'AUTORIZAR\';$(\'#modalConfirmacion\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'aceptar','tamanio'=>'pequeño',  'adicional'=>'');
$btnaceptar=array('tipo'=>'link','nombre'=>'aceptado', 'id' => 'aceptado', 'titulo'=>'&nbsp;Aceptar', 'link'=>'', 'onclick'=>'estado=\'ACEPTADO\';$(\'#modalAceptar\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'aceptar','tamanio'=>'pequeño',  'adicional'=>'');
$btncancelar=array('tipo'=>'link','nombre'=>'cancelar', 'id' => 'cancelar', 'titulo'=>'&nbsp;Cancelar', 'link'=>'', 'onclick'=>'estado=\'CANCELADO\';$(\'#modalConfirmacion\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'pequeño',  'adicional'=>'');

switch ($data->estatuspedido) {
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
        $btnenatencion=array();$btncancelar=array();$btnaceptar=array();$btngenerar=array();
        $btndevolver=array('tipo'=>'link','nombre'=>'anular', 'id' => 'anular', 'titulo'=>'&nbsp;Anular', 'link'=>'', 'onclick'=>'estado=\'ANULAR\';$(\'#modalAnular\').modal(\'show\');' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'cancelar','tamanio'=>'pequeño',  'adicional'=>'');
        break;

    case 'CANCELADA':
        $stylestatuscit='badge-danger';
        $btnatendido=array();$btncancelar=array();

        break;

    case 'AUTORIZADO':
        $stylestatuscit='badge-secondary';
        $btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btngenerar=array();
        break;

    case 'ENVIADO':
        $stylestatuscit='badge-secondary';
        $btnautorizar=array();$btncancelar=array();$btngenerar=array();
        break;

    case 'GENERADO':
        $stylestatuscit='badge-primary';
        $btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btngenerar=array();
        break;

        case 'ANULADO':
            $stylestatuscit='badge-danger';
            $btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btngenerar=array();
            break;

    case 'FACTURADO TOTAL':
        $stylestatuscit='badge-secondary';
        $btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btngenerar=array();
        break;

    case 'FACTURADO PARCIAL':
        $stylestatuscit='badge-warning';
        $btnautorizar=array();$btndevolver=array();$btnaceptar=array();$btncancelar=array();$btngenerar=array();
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
       $btngenerar,
       $btnaceptar,
       $btnautorizar,
       $btndevolver,
       $btncancelar,


));

$botonarchivo=$botones->getBotongridArray(
    array(
       //array('tipo'=>'link','nombre'=>'pdf', 'id' => 'pdf', 'titulo'=>'&nbsp;Ver', 'link'=>'/backend/web/images/pedidos/'.$data->imagen, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'naranja', 'icono'=>'archivo','tamanio'=>'pequeño','target'=>'blank',  'adicional'=>''),
));

$contenido='<div style="line-height:30px;" class="row"><div class="col-4 col-md-4"><b>Pedido Prod #:  </b>'.$data->id.'<br></div>';
$contenido.='<div class="col-4 col-md-4"><b>Pedido Venta #</b>'.$data->idpedido.'<br></div>';
$contenido.='<div class="col-4 col-md-4"><b>Fecha:  </b>'.$data->fechacreacion.'<br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
 
 
//$contenido.='<div class="col-6 col-md-3 mb-3"><b>Documento: </b>&nbsp; '.$botonarchivo.'</span><br></div>';
//$contenido.='<div class="col-6 col-md-3 mb-3"><b>Cartera: </b>&nbsp; <span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp;&nbsp;AL DÍA</span> </span><br></div>';
//$contenido.='<div class="col-6 col-md-3 mb-3"><b>Cartera: </b>&nbsp; <span class="badge badge-warning"><i class="fa fa-circle"></i>&nbsp;&nbsp;VENCIDA (40 DÍAS)</span> </span><br></div>';
//$contenido.='<div class="col-12 col-md-12"><b>Notas:</b>&nbsp; '.$data->notas.'</span><br></div>';
//$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';



 if ($data->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus pedido:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatuscit.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$data->estatuspedido.'</span><br>';
 $contenido2.='<b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$data->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$data->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$data->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp;'.$data->usuarioactualizacion0->username. '</span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp;'.$data->fechaact. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

 $tabla='<div class="col-12 mt-2" style="width: 100%;overflow-x: scroll;">
 <table class="table table-striped">
 <thead>
   <tr>
     <th scope="col">Cant.</th>
     <th scope="col">Item</th>
 

   </tr>
 </thead>
 <tbody>';
$cont=0; $cont2=1; $tdescuento=0; $tiva=0; $tcantidad=0;$tsubtotal=0;

 foreach ($data->pedido0->pedidosdetalle as $key => $value) {
    $scope= ($con==1)? $scope='scope="row"' : $scope='';
    $tcantidad+=$value->cantidad;
    $tsubtotal+=$value->total;
    $tiva+=($value->iva*$value->cantidad);
    $tdescuento+=$value->descuento;
   // if ($value->debito==0){ $debe=$value->valor; $sumdebe+=$value->valor; $haber=0; }else{  $haber=$value->valor;  $sumhaber+=$value->valor; $debe=0;     }
    $tabla.=' <tr><td '.$scope.'>'.number_format($value->cantidad,2).'</td><td>'.$value->nombreprod.'</td>';
    $tabla.='</tr>';
    $cont++; $cont2++;
    ($con==2)? $cont=0 : $cont=$cont;
 }
$tabla.='</tbody></table><table class="table table"> <tbody><tr><td class="text-center"><b>Items: </b>'.$cont.'</td><td class="text-center"><b>T. Cant.: </b>'.number_format($tcantidad,3).'</td>';
$tabla.='</tr>';

   $tabla.='</tbody></table></div>';
 //  var_dump($data->pedidosmensajes);
 
    $contenido.=$tabla.$mensajes;


$form = ActiveForm::begin(['id'=>'frmDatos']);
    echo '<input type="hidden" id="estado" name="estado" /> ';
    echo '<input type="hidden" id="pedido" name="pedido" value="'.$data->id.'" /> ';
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'pedido','id'=>'pedido','titulo'=>'Datos del pedido','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'bloc1','id'=>'bloc1','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

$modal= New Modal;
$estatusmen="cambiar el estatus";

$modalGenerar= $modal->getModal('okcancel','modalGenerar','modalGenerar', '', '¿Desea generar la órden del pedido de producción?', '', '', '','','cambiarEstado(false)','$(\'#modalGenerar\').modal(\'hide\');','' );
$modalAceptar= $modal->getModal('okcancel','modalAceptar','modalAceptar', '', '¿Desea aceptar el pedido, y enviarlo para su autorización final?', '', '', '','','cambiarEstado(false)','$(\'#modalAceptar\').modal(\'hide\');','' );
$modalEnviar= $modal->getModal('okcancel','modalEnviar','modalEnviar', '', '¿Desea generar una orden de producción?', '', '', '','','cambiarEstado(false)','$(\'#modalEnviar\').modal(\'hide\');','' );
$modalAnular= $modal->getModal('okcancelinput','modalAnular','modalAnular', '', '¿Desea anular el pedido, el mismo no podrá ser nuevamente activado?', '', '', '','width: 80%;','cambiarEstado(true)','$(\'#modalAnular\').modal(\'hide\');','' );
$modalDevolver= $modal->getModal('okcancelinput','modalDevolver','modalDevolver', '', '¿Desea devolver el pedido?', '', '', '','width: 80%;','cambiarEstado(true)','$(\'#modalDevolver\').modal(\'hide\');','' );
echo $modalAutorizar;
echo $modalEnviar;
echo $modalGenerar;
echo $modalAnular;
if ($data->estatuspedido=="ENVIADO"){echo $modalDevolver;}

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
