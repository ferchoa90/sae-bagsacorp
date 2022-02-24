<?php
use yii\widgets\ActiveForm;
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Estado de cuenta proveedores";
$this->params['breadcrumbs'][] = $this->title;

$urlpost="/backend/web/reportes/estadoproveedoresfilter";
$objeto= new Objetos;
$div= new Bloques;
//var_dump($clientes);
 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'proveedores', 'id'=>'proveedores', 'valor'=>$proveedores, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Proveedor: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'fecha', 'nombre'=>'desde', 'id'=>'desde', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Desde: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'fecha', 'nombre'=>'hasta', 'id'=>'hasta', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Hasta: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'boton','nombre'=>'filtrar', 'id' => 'filtrar', 'titulo'=>'&nbsp;Filtrar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'negro', 'icono'=>'filtro','tamanio'=>'pequeño',  'adicional'=>'')
    ),true
);
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-9 col-xs-12 ','','','','');
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-3 col-xs-12 ','','','','');
 //echo $contenido;
 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        //array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')
));
$contenido.='<hr style="color: #0056b2;">';

$tabla='<div class="col-12" style="width: 100%;overflow-x: scroll;">
<table id="reporte" class="table table-striped">
 <thead>
   <tr>
     <th scope="col">Comprobante</th>
     <th scope="col">Movimiento</th>
     <th scope="col" class="text-center">Fecha</th>
     <th scope="col" class="text-center">Tipo</th>
     <th scope="col" class="text-center">Concepto</th>
     <th scope="col" class="text-center">Valor</th>
     <th scope="col" class="text-center">Abono</th>
     <th scope="col" class="text-center">Saldo</th>
     <th scope="col" class="text-center">Vence</th>
     <th scope="col" class="text-center">Días</th>
   </tr>
 </thead>
 <tbody id="reportebody">';
//
$tabla.="</tbody></table></div>";

$form = ActiveForm::begin(['id'=>'frmDatos']);
echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'','clase'=>'col-md-12 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$tabla.$botonC),
    )
);
ActiveForm::end();
//var_dump($objeto);
?>

<script>
  $(document).ready(function(){
        //$("#frmDatos").find(':input').each(function() {
        // var elemento= this;
         //console.log("elemento.id="+ elemento.id + ", elemento.value=" + elemento.value);
        //});
        $("#filtrar").on('click', function() {
            if (validardatos()==true){
                var form    = $('#frmDatos'),
                nombre   = $('#nombrerol').val(),
                descripcion   = $('#descripcion').val();
                loading(1);
                $.ajax({
                    url: '<?= $urlpost ?>',
                    async: 'false',
                    cache: 'false',
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response){
                    data=JSON.parse(response);
                    //console.log('RESP: '+response);
                    //console.log('DATA: '+data);

                    if ( data ) {
                      agregarData(response);
                        // ============================ Not here, this would be too late
                        //notificacion(data.mensaje,data.tipo);
                        //$this.data().isSubmitted = true;
                        //$('#frmDatos')[0].reset();
                      loading(0);

                        return true;
                    }else{
                        //notificacion(data.mensaje,data.tipo);
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

       function agregarData(data)
       {
        var tds;
        var html;
        console.log(data);
        $('#reportebody').html('');
        var valor=0; var abono=0; var saldo=0;

        $.each(JSON.parse(data), function(i, item) {
            //alert(item.numerofactura);
            var scope='scope="row"';
            var style='';
            //if (i % 2) { scope='scope="row"' }else{ scope=''; }

            if (item.tipoaux=="FAC"){ style='style="background-color: rgba(0,0,0,.05)"';}
            if (item.tipoaux=="RET"){ style='style="background-color: white;"'; }
            if (item.tipoaux=="TRA"){ style='style="background-color: white;"'; }
            if (item.tipoaux=="CHD"){ style='style="background-color: white;"'; }
            html+='<tr '+style+' >'+"<td>"+item.numerofactura+"</td>";
            html+="<td>"+item.movimiento+"</td>";
            html+="<td>"+item.fecha+"</td>";
            html+="<td>"+item.tipoaux+"</td>";
            html+="<td>"+item.concepto+"</td>";
            html+="<td>"+item.valor+"</td>";
            html+="<td>"+item.abono+"</td>";
            html+="<td>"+item.saldo+"</td>";
            html+="<td>"+item.vencimiento+"</td>";
            html+="<td>"+item.dias+"</td>";
            valor=item.valort;
            abono=item.abonot;
            saldo=item.saldot;

        });
        html+='<tr style="background-color: white;"><td></td><td></td><td></td><td></td><td><b>S. Ant.:</b> 0.00</td><td><b>V. Tot.: </b> '+valor+'</td>';
        html+='<td><b>Ab. T.: </b>'+abono+'</td><td><b>S. Cor.: </b>'+saldo+'</td><td></td><td></td></tr>';
        $('#reporte > tbody:last-child').append(html);
       }

       function validardatos()
       {
           //console.log("validardatos");
            if ($('#cliente').attr('selected', 'selected').val()!="-1"){
                if ($('#desde').val()!=""){
                    if ($('#hasta').val()!=""){
                         return true;
                    }else{
                        $('#hasta').focus();
                        return false;
                    }
                }else{
                    $('#desde').focus();
                    return false;
                }
            }else{
                $('#cliente').focus();
                return false;
            }
       }


  </script>
