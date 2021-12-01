<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->title = 'Iniciar sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Mario Aguilar Jiménez">
	<title>Login Page</title>
</head>

<body>
	<!-- Main Content -->
	<div class="container-fluid">
		<div class="  main-content bg-success text-center">
            <div class="card">
                <div class="row">
                    <div class="col-md-8 cart">
                        <div class="title border-bottom">
                            <div class="row">
                                <div class="col">
                                    <h4 class="text-left"><b>Pedido</b></h4>
                                </div>
                                <div class="col align-self-center text-right text-muted" id="items">3 Platos</div>
                            </div>
                        </div>


                        <div id="contenidoCarrito">

                        </div>


                        <div class="back-to-shop"><a href="<?= URL::base() ?>/site/pedidos">&leftarrow;</a><span class="text-muted">Regresar a pedidos</span></div>
                    </div>
                    <div class="col-md-4 summary">
                        <div>
                            <h5><b>RESUMEN</b></h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col" style="padding-left:0;">TOTAL</div>
                            <div class="col text-right"  id="subtotalprecio">$ 132.00</div>
                        </div>
                        <form>
                            <p>ENVÍO</p>
                            <select class="form-control select2" onchange="javascript:recargoDomicilio();" style="width: 100%;" id="sucursal">
                                <option class="text-muted" >seleccione...</option>
                                <?php $cont=0; $valpedido= array(); foreach ($pedidozona as $key => $value) { ?>
                                    <?php  $valpedido[$cont]=$value->total; ?>
                                    <option class="text-muted" value="<?=$value->id ?>" <?php if($cont==0){ echo 'selected="selected" ';  } ?>  ><?=$value->descripcion ?></option>
                                <?php $cont++; } ?>
                            </select>
                            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
</svg><span style="font-size:10px;"> &nbsp;Cobertura a domicilio</span></p>

                            <p style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">Código de descuento</p> <input id="code" placeholder="Ingrese el código">
                        </form>
                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div class="col">ENVÍO</div>
                            <div class="col text-right" id="envio">$ 0.00</div>
                        </div>
                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div class="col">TOTAL</div>
                            <div class="col text-right" id="totalprecio">$ 0.00</div>
                        </div>

                        <button onclick="javascript:realizarOrden();" class="btn btnordenar">ORDENAR</button>
                    </div>
                </div>
            </div>

		</div>
	</div>
	<!-- Footer -->

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
	<div class="container-fluid text-center footer">
		Design by <a href="#">Acep Sistemas.</a></p>
	</div>

<script>
var valRecargo=0;
dataCard = [];
inicializarCompras();

function realizarOrden()
{
    loading(true);
    var dataPedido = JSON.parse(localStorage.getItem('cardID'));
      var idfac=0;
      if (!$('#sucursal').val()){
        //$('#cliente').val('9999999999');
        //obtenerCliente($('#cliente').val());
      }
      var sucursal=$('#sucursal').val();
      var codigo=$('#code').val();
      

      
      $.ajax({
          url:"ingresarpedido",
          method:"POST",
          data: { data: dataPedido, sucursal:sucursal,'_csrf-frontend':'<?=Yii::$app->request->getCsrfToken()?>', codigo:codigo },
          //dataType:\"json\",
          success:function(data)
          {
            var data = jQuery.parseJSON(data);
            //loading(0);
            //console.log(data.success)
            if (data.success) {
                if (data.id)
                {
                    loading(false);
                  //imprimirFactura(data.id);
                }
            } else {
                 alert('No se ha podido guardar la factura');
                //$.notify(data.Mensaje);
            }
          }
      });
}


function recargoDomicilio()
{
    var jArray= <?php echo json_encode($valpedido ); ?>;
//var valrecargo=[<?php echo '"'.implode('","', $valpedido).'"' ?>];
var indiceSelect=$("#sucursal")[0].selectedIndex-1;
//console.log(jArray[indiceSelect])
valRecargo=jArray[indiceSelect];
$("#envio").html("$ "+valRecargo);
//console.log(jArray)
armarItems();

}
function inicializarCompras()
  {
      if (localStorage.getItem('cardID')) {
          dataCard = JSON.parse(localStorage.getItem('cardID'));
          //armarGrid();
      } else {
          if (!localStorage.getItem('cardID')) {
              //listarFacturas();
              localStorage.setItem('cardID', JSON.stringify(dataCard));
          }
      }
  }
  recargoDomicilio();
    armarItems();

    function armarItems()
    {
    var totalProd=0;
    var itemsearch=false;
    //console.log(data);
    html="No hay productos en tu lista";
        if (dataCard){
            html="";
        //console.log('V: '+data.preciovp);
        var step=false;
        var iniciodiv='<div class="row  border-bottom item-pedido"><div class="row main align-items-center">';
        var findiv='</div>';
        var col2='<div class="col-2">';
        var col10='<div class="col-10">';
        var col='<div class="col">';
        var img='';
        var divnombre;
        var divdescripcion;
        var cantidad;
        var restar;
        var sumar;
        var colprecio;



            var total=0;

            if (dataCard.length>0){
                for (var i = 0, l = dataCard.length; i < l; i++) {
                img='<img class="img-fluid" src="/frontend/web/images/articulos/menuproducto.fw.png" id="itemimage_">';
                divnombre='<div class="row text-muted" id="itemnombre_">'+dataCard[i].nombre+'</div>';
                divdescripcion='<div class="row font-10" id="itemdescripcion_">'+dataCard[i].descripcion+'</div>';
                sumar='<a class="botonaq" href="javascript:restarItem('+i+')">-</a>';
                cantidad='<a href="#" class="" id="itemcantidad_'+i+'">'+dataCard[i].cantidad+'</a>';
                restar='<a class="botonaq" href="javascript:sumarItem('+i+')">+</a> ';
                colprecio='<div class="col" id="itemprecio_">$ '+(dataCard[i].total)+'<span onclick="javascript:eliminarItem('+i+')" class="close">✕</span></div>';
                //console.log('Encontró');
                //itemsearch=true;
                //dataCard[i].cantidad = parseFloat(dataCard[i].cantidad)+1;
                //dataCard[i].total = parseFloat(dataCard[i].total)+parseFloat(data.total);
                //dataCard[i].total=dataCard[i].total.toFixed(2)
                //console.log(data.total);
                //$('#preciot-'+(i+1)).html((parseFloat(dataCard[i].valoru).toFixed(2)*parseInt(dataCard[i].cantidad)).toFixed(2));
                //total=parseFloat(total)+parseFloat(dataCard[i].total);
                html+=iniciodiv+col2+img+findiv+col10+divnombre+divdescripcion+findiv+col+sumar+cantidad+restar+findiv+col+colprecio+findiv+findiv+findiv+findiv+findiv;
                total+=parseFloat(dataCard[i].total);
                totalProd=i;
        }
            //console.log(html);
        $("#contenidoCarrito").html(html);
        $("#subtotalprecio").html('$ '+parseFloat(total).toFixed(2));
        $("#totalprecio").html('$ '+parseFloat(parseFloat(total)+parseFloat(valRecargo)).toFixed(2));
            }else{
                html="No hay productos en tu lista";
            }
        }
        $("#items").html((totalProd+1)+' Items');
        $("#contenidoCarrito").html(html);
    }

    function sumarItem(index){
        var precio= parseFloat(dataCard[index].valorunitario);

        var cantidad= dataCard[index].cantidad;
        //console.log(precio);
        dataCard[index].cantidad=cantidad+1;
        dataCard[index].total=parseFloat(precio*(cantidad+1)).toFixed(2);
        localStorage.setItem('cardID', JSON.stringify(dataCard));
        armarItems();
    }

    function restarItem(index){
        var precio= parseFloat(dataCard[index].valorunitario);

        var cantidad= dataCard[index].cantidad;
        if (cantidad>1){
          //console.log(precio);
            dataCard[index].cantidad=cantidad-1;
            dataCard[index].total=parseFloat(precio*(cantidad-1)).toFixed(2);
            localStorage.setItem('cardID', JSON.stringify(dataCard));
            armarItems();
        }

    }

    function eliminarItem(index)
    {
        dataCard.splice(index, 1);
        localStorage.setItem('cardID', JSON.stringify(dataCard));
        armarItems  ();
    }
</script>

<style>
    .item-pedido:hover{
        background: bisque !important;
    }
    .text-muted
    {
        color: darkred !important;
    }

.select2{
    padding-left:0.5em;
}
.main-content
{
    width: 60%;
}
.botonaq:hover
{
    background-color: darkred;
    color:white !important;
}
.bg-success {
    /*background-color: black!important;*/
    background: -webkit-linear-gradient(left, darkred,rgba(0, 0, 0, .9));
}


.title {
    margin-bottom: 5vh
}

.card {
    margin: auto;
    max-width: 950px;
    width: 90%;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 1rem;
    border: transparent
}

@media(max-width:767px) {
    .card {
        margin: 3vh auto
    }
}

.cart {
    background-color: #fff;
    padding: 4vh 5vh;
    border-bottom-left-radius: 1rem;
    border-top-left-radius: 1rem
}

@media(max-width:767px) {
    .cart {
        padding: 4vh;
        border-bottom-left-radius: unset;
        border-top-right-radius: 1rem
    }
}

.summary {
    /*background-color: #ddd;*/
    background: -webkit-linear-gradient(left, darkred,darkred);
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    padding: 4vh;
    color:white;
}

@media(max-width:767px) {
    .summary {
        border-top-right-radius: unset;
        border-bottom-left-radius: 1rem
    }
}

.summary .col-2 {
    padding: 0
}

.summary .col-10 {
    padding: 0
}

.row {
    margin: 0
}

.title b {
    font-size: 1.5rem
}

.main {
    margin: 0;
    padding: 2vh 0;
    width: 100%
}

.col-2,
.col {
    padding: 0 1vh
}

a {
    padding: 0 1vh
}

.close {
    margin-left: auto;
    font-size: 0.7rem;
    cursor: pointer;
}

img {
    width: 3.5rem
}

.back-to-shop {
    margin-top: 4.5rem
}

h5 {
    margin-top: 4vh
}

hr {
    margin-top: 1.25rem
}

form {
    padding: 2vh 0
}

select {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247)
}

input {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247)
}

input:focus::-webkit-input-placeholder {
    color: transparent
}

.btnordenar {
    background-color: #000;
    border-color: #000;
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin-top: 4vh;
    padding: 1vh;
    border-radius: 0
}

.btn:focus {
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none
}

.btn:hover {
    color: white
}

.col a {
    color: black
}

.col a:hover {
    color: black;
    text-decoration: none
}

#code {
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center
}
    </style>
</body>