<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use backend\models\Productos;
use backend\models\Subproducto;
use backend\models\Menuprincipal;

AppAsset::register($this);

//$productos= Productos::find()->where(['isDeleted' => '0',"estado"=>"ACTIVO"])->orderBy(["orden" => SORT_ASC])->limit(6)->all();
//$menuprincipal= Menuprincipal::find()->where(['estado' => 'ACTIVO'])->orderBy(["orden" => SORT_ASC])->limit(7)->all();
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
<?= Html::csrfMetaTags() ?>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="SAE - Sistema Administrativo Contable">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?= URL::base() ?>/images/favicon.ico" type="image/x-icon">
<meta name="author" content="">
<title>SAE - Sistema Empresarial</title>

<!-- Bootstrap core CSS -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,800" rel="stylesheet">

<!-- Custom styles for this template -->
<script src="<?= URL::base() ?>/js/jquery-1.12.4.min.js"></script>
<script src="<?= URL::base() ?>/js/jquery.mask.min.js"></script>
<script src="<?= URL::base() ?>/js/jquery-ui.js"></script>

<!-- include alertify script -->
<script src="<?= URL::base() ?>/js/alertify.js"></script>
<script src="<?= URL::base() ?>/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Custom fonts for this template-->
<link href="<?= URL::base() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>





<link  href="<?= URL::base() ?>/css/pedidos.css" rel="stylesheet" type="text/css">
<?php $this->head() ?>
</head>


        <div class="col-lg-12 col-sm-12 col-12   d-flex   justify-content-center mb-3 ">
        <div class="col-lg-8 col-sm-8 col-8 main-section   bd-highlight ">
            <ul class="nav justify-content-center nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= URL::base() ?>/site/loginweb">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?= URL::base() ?>/site/pedidos">Menú</a>
                </li>
                <li class="nav-item dropdown">
                    <a  class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carro <span class="badge badge-pill badge-danger" id="totalitems">0</span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                            <div class="col-lg-6 col-sm-6 col-6">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger" id="totalitems2">0</span>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                <p>Total: <span class="text-info"  id="totalvalor">$ 0.00</span></p>
                            </div>
                        </div>
                      <div id="cardCompra"></div>


                        <div class="row">
                            <div class="col-lg-2 col-sm-2 col-2 checkout">
                            </div>

                            <div class="col-lg-8 col-sm-8 col-8 text-center checkout">
                                <button onclick="javascript:window.location.href='<?= URL::base() ?>/site/carrito'" class="btn btn-primary btn-block">Ordenar</button>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-2 checkout">
                            </div>
                        </div>
                    </div>
                </li>
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= URL::base() ?>/site/loginweb">Iniciar Sesión</a>
                        </li>
                    <?php }else{ ?>
                        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user" aria-hidden="true"></i> <?php echo Yii::$app->user->identity->nombres ?>
        </a>
        <div class="dropdown-menu dropdown-menu2 menu-user" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Mi Perfil</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Mis pedidos</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Cerrar sesión</a>
        </div>
      </li>


                    <?php } ?>
            </ul>
        </div>
        </div>


<?php $this->beginBody() ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<?= $content ?>
<?php //$this->endBody() ?>
<div id="cover-spin"></div>
<script>
    function loading(mode){
        if (mode==true)
        {
            $("#cover-spin").show()
        }else{
            $("#cover-spin").hide()
        }
    }
    </script>
<?php $this->endPage() ?>