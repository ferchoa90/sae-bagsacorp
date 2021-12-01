<?php
use backend\components\Pedido;
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
                    <div class="col-md-12 cart">
                        <div class="title border-bottom">
                            <div class="row">
                                <div class="col">
                                    <h4 class="text-left"><b>Pedido Actual</b></h4>
                                </div>
                                <div class="col align-self-center text-right text-muted parpadea" id="items"><?php $clasepedido= new Pedido; echo $clasepedido->getEstatuspedido($pedidos[0]->estatuspedido) ?></div>
                            </div>
                        </div>
                        <div id="contenidoPedidos">
                            <?php foreach ($pedidos as $key => $value) { ?>
                                <div id="accordion">
                                <div class="card pedidos">
                                    <div class="card-header" id="pedido-<?= $value->id ?>">
                                    <h5 class="mb-0 col-12">
                                        <a class="btn btn-link col-12 row" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <div class="col-11 text-left" >Pedido # 000<?= $value->id ?></div>

                                            <div class="col-1" ><i class="fa fa-chevron-down" style="color:white;font-size: 10px;" aria-hidden="true"></i></div>
                                        </a>
                                    </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="pedido-<?= $value->id ?>" data-parent="#accordion">
                                        <div class="card-body">
                                            <!--Table-->
                                            <table class="table table-striped w-auto">
                                                <!--Table head-->
                                                <thead>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <th>Nombre</th>
                                                    <th>Descripcion</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <!--Table head-->

                                                <!--Table body-->
                                                <tbody>
                                                <?php $cont=0; ?>
                                                <?php foreach ($pedidosdetalle["detalle"][$value->id] as $key => $valuedet) { ?>

                                                    <?php if ($cont % 2 ==0){ $style="table-info"; }else{ $style=""; } ?>
                                                    <tr class="<?=$style ?>">
                                                        <td scope="row"><?= $valuedet->cantidad ?></th>
                                                        <td><?= $valuedet->nombre ?></td>
                                                        <td><?= $valuedet->descripcion ?></td>
                                                        <td>$ <?= number_format($valuedet->subtotal*$valuedet->cantidad,2) ?></td>
                                                    </tr>

                                                    <?php $cont++; ?>
                                                <?php }?>


                                                </tbody>
                                                <!--Table body-->


                                            </table>
                                            <!--Table-->
                                        </div>
                                    </div>



                                </div>

                                </div>
                            <?php
                            //var_dump($pedidos["cabecera"]);
                            }
                            ?>
                        </div>


                        <div class="back-to-shop"><a href="<?= URL::base() ?>/site/pedidos">&leftarrow;</a><span class="text-muted">Regresar a mis órdenes</span></div>
                    </div>

                </div>
            </div>

		</div>
	</div>
	<!-- Footer -->

	<div class="container-fluid text-center footer">
		Design by <a href="#">Acep Sistemas.</a></p>
	</div>

<script>
var valRecargo=0;
dataCard = [];

</script>

<script>
  //Cuando la página esté cargada completamente
  $(document).ready(function(){
    //Cada 10 segundos (10000 milisegundos) se ejecutará la función refrescar
    setTimeout(refrescar, 10000);
  });
  function refrescar(){
    //Actualiza la página
    location.reload();
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

.parpadea {

  animation-name: parpadeo;
  animation-duration: 1s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 1s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
}

@-moz-keyframes parpadeo{
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

@-webkit-keyframes parpadeo {
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@keyframes parpadeo {
  0% { opacity: 1.0; }
   50% { opacity: 0.0; }
  100% { opacity: 1.0; }
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