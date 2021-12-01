<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
//$productos= Productos::find()->where(['isDeleted' => '0',"estado"=>"ACTIVO"])->orderBy(["orden" => SORT_ASC])->limit(6)->all();
//$slider= Slider::find()->where(['isDeleted' => '0',"estatus"=>"Activo"])->orderBy(["orden" => SORT_ASC])->limit(7)->all();
//News::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_DESC])->limit(100)->all();
$this->title = 'SAE - Sistema Administrativo Contable';
?>

        <!-- Begin Page Content -->

<div class="shop-default shop-cards shop-tech">
    <div class="col-lg-12 col-sm-12 col-12   d-flex   justify-content-center mb-3 ">
        <div class="col-lg-8 col-sm-8 col-8 main-section   ">
            <div class="row">
                <?php foreach ($menu as $key => $value): ?>
                <div class="col-md-3 productos">
                    <div class="block product no-border z-depth-2-top z-depth-2--hover">
                        <div class="block-image">
                            <a href="#">
                                <img src="<?= URL::base() ?>/images/articulos/menuproducto.fw.png" class="card-img-top">
                            </a>
                        </div>
                        <div class="block-body text-center">
                            <h3 class="heading heading-5 strong-600 text-capitalize">
                                <a href="#">
                                    <?= $value->nombre; ?>
                                </a>
                            </h3>
                            <p class="product-description">
                                <?php $menuNombre=($value->producto10->nombreproducto)? $value->producto10->nombreproducto : '' ; ?>
                                <?php $menuNombre.=($value->producto20->nombreproducto)? ' + '.$value->producto20->nombreproducto : '' ; ?>
                                <?php $menuNombre.=($value->producto30->nombreproducto)? ' + '.$value->producto30->nombreproducto : '' ; ?>
                                <?php $menuNombre.=($value->producto40->nombreproducto)? ' + '.$value->producto40->nombreproducto : '' ; ?>
                                <?= $menuNombre ?>
                               <span class="preciocombo"> <?= ($value->valor)? ' <br>$ '.number_format($value->valor+$value->iva,2).'<br>' : '' ; ?> </span>
                            </p>
                            <div class="product-buttons mt-4">
                                <div class="row align-items-center">
                                    <!--<div class="col-2">
                                        <button type="button" class="btn-icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Favorite">
                                            <i class="fa fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn-icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare">
                                            <i class="fa fa-share"></i>
                                        </button>
                                    </div>-->
                                    <div class="col-12" style="padding-left:0px;padding-right:0px;">
                                        <button id="btnpedir-<?= $value->id; ?>" onclick="javascript:agregarPedido('<?= $value->id; ?>','<?= $value->nombre; ?>','<?= $menuNombre; ?>','<?= $value->producto10->id; ?>','<?= $value->producto20->id; ?>','<?= $value->producto30->id; ?>','<?= $value->producto40->id; ?>','<?= $value->valor; ?>','<?= $value->iva; ?>',1,true);" type="button" class="btn btn-small btn-primary btn-circle btn-icon-left product-buttons-cart">
                                            <i class="fa fa-money"></i>&nbsp;&nbsp;Pedir
                                        </button>
                                        <button id="btnagregar-<?= $value->id; ?>" onclick="javascript:agregarPedido('<?= $value->id; ?>','<?= $value->nombre; ?>','<?= $menuNombre; ?>','<?= $value->producto10->id; ?>','<?= $value->producto20->id; ?>','<?= $value->producto30->id; ?>','<?= $value->producto40->id; ?>','<?= $value->valor; ?>','<?= $value->iva; ?>',1,false);" type="button" class="btn btn-small btn-primary btn-circle btn-icon-left product-buttons-cart">
                                            <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Agregar
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<style> </style>
<?php
setcookie("cartID", "0", time()+3600, "/","", 0);



?>


<script>

  function agregarRedirec()
  {

    window.location.href = '<?= URL::base() ?>/site/carrito';
  }
var a=getCookie('productosCart');
//console.log(a);
function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');


  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    //console.log(c);
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }

  }
  return "";
}
dataCard = [];
inicializarCompras();
armarGrid()
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

  function agregarPedido(id,nombre,descripcion,ped1,ped2,ped3,ped4,valor,iva,cantidad,redirect){
    var dataPedidos;
        dataPedidos = {
          id: id,
          nombre: nombre,
          descripcion: descripcion,
          idproducto1: ped1,
          idproducto2: ped2,
          idproducto3: ped3,
          idproducto4: ped4,
          cantidad: cantidad,
          valorunitario: valor,
          total: valor,
          iva: false,
          estatus: true,
        };
        console.log(dataPedidos.id);
        agregarItemPedido(dataPedidos)
    if (redirect){
      agregarRedirec()
    }
  }

  function agregarItemPedido(data) {
    var itemsearch=false;
    //var total=$('#total').html(total);
    console.log(data);
    if (data){
      //console.log('V: '+data.preciovp);
      var step=false;
      for (var i = 0, l = dataCard.length; i < l; i++) {
        if (dataCard[i].id == data.id && dataCard[i].valoru == data.preciovp && step==false) {
            //console.log('Encontró');
            itemsearch=true;
            dataCard[i].cantidad = parseFloat(dataCard[i].cantidad)+1;
            dataCard[i].total = parseFloat(dataCard[i].total)+parseFloat(data.total);
            dataCard[i].total=dataCard[i].total.toFixed(2)
            console.log(data.total);
            //$('#preciot-'+(i+1)).html((parseFloat(dataCard[i].valoru).toFixed(2)*parseInt(dataCard[i].cantidad)).toFixed(2));
            //total=parseFloat(total)+parseFloat(dataCard[i].total);
        }
      }
      if (itemsearch==false){
        //console.log('nuevo');
        var dataFavNew;
        dataFavNew = {
          id: data.id,
          nombre: data.nombre,
          descripcion: data.descripcion,
          idproducto1: data.idproducto1,
          idproducto2: data.idproducto2,
          idproducto3: data.idproducto3,
          idproducto4: data.idproducto4,
          valorunitario: data.total,
          cantidad: 1,
          total: data.total,
          iva: false,
          estatus: false,
        };
        dataCard.push(dataFavNew);
      }
    }else{
      //console.log('adiciona');
      var dataFavNew;
      dataFavNew = {
        id: data.id,
          nombre: data.nombre,
          descripcion: data.descripcion,
          idproducto1: data.idproducto1,
          idproducto2: data.idproducto2,
          idproducto3: data.idproducto3,
          idproducto4: data.idproducto4,
          cantidad: 1,
          total: data.total,
          iva: false,
          estatus: false,
      };
      total=data.total;
      dataCard.push(dataFavNew);
    }
    //$('#total').html(total);
    localStorage.setItem('cardID', JSON.stringify(dataCard));
    armarGrid()

  }

  function armarGrid()
  {
    var dataint = [];
    dataint = dataCard;
    var html='';
    var total=0;
    var totalcantidad=0;

    for (var i = 0, l = dataint.length; i < l; i++) {
      var obj = dataint[i];
      //console.log(obj);
      nproductos=i+1;
      var cantidad=obj.cantidad;
      var descripcion=obj.descripcion;
      var idproducto=obj.id;
      var preciou=obj.valoru;
      var valor=obj.total;
      var divini='<div class="row cart-detail">';
      var divfin='</div>';
      var divimg='<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">';
      var contenidoimg='<img src="/frontend/web/images/articulos/menuproducto.fw.png">'
      var divproducto='<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">';
      var nombreprod=obj.nombre;
      var valorprod=obj.total;
      var contenidoprod;

      contenidoprod='<p>'+nombreprod+'</p><span class="text-info1">'+descripcion+'</span><br><span class="price text-info">'+valorprod+'</span> <span class="count"> Cantidad : '+cantidad+'</span>';
      var inputprecio='<input onkeypress=\"javascript:cambiarPrecio('+nproductos+',this)\" onchange=\"javascript:cambiarPrecio('+nproductos+',this)\"  id=\"prec-'+nproductos+'\" step=\".01\" style=\" width: 35%;text-align: right;\"  type=\"number\" value=\"'+preciou+'\" >';
      var color=obj.color;
      var clasificacion=obj.clasificacion;
      preciou=(parseFloat(preciou)).toFixed(2);
      var cantidad=obj.cantidad;
      var preciot=obj.total;

      html+=divini+divimg +contenidoimg +divfin+divproducto+contenidoprod+divfin+divfin+divfin;
      //trfin;
      //html=html;
      total+=(parseFloat(valor));
      totalcantidad++;
    }
    //console.log(total);
    $('#totalitems').html(totalcantidad);
    $('#totalitems2').html(totalcantidad);
    $('#totalvalor').html(total.toFixed(2));
   $('#cardCompra').html(html);
//console.log(html)
  }

</script>

      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; ACEP SISTEMAS 2020</span>
          </div>
        </div>
      </footer>
