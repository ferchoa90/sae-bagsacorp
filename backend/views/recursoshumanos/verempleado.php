<?php



use yii\helpers\Html;

use yii\widgets\DetailView;

use backend\components\Globaldata;


use yii\helpers\Url;



/* @var $this yii\web\View */

/* @var $model app\models\TriviaHead */



$iconNone = "https://www.gstatic.com/onebox/sports/logos/inverse-crest.svg";



$this->title = "Ver Empleado";

$this->params['breadcrumbs'][] = ['label' => 'Administración de Empleados', 'url' => ['index']];

$this->params['breadcrumbs'][] = $this->title;



?>

<div class="trivia-head-view">



    <p>

 

    </p>



    <div class="row">

        <div class="col-md-6">

            <div class="box box-solid">

                <div class="box-header with-border">

                    <i class="fa fa-gear"></i>

                    <h3 class="box-title">Perfil de Usuario</h3>

                </div><!-- /.box-header -->

                <div class="box-body">

                    <dl class="dl-horizontal">

                        <dt>Fecha de Creación:</dt>

                        <dd><?= $model->fechacreacion ?></dd>

                      

                         

                        <dt>Estado:</dt>

                        <dd>

                            <?php if ($model->estatus == 'ACTIVO') { ?>

                                <span class="label label-success"><i class="fa fa-circle"></i>&nbsp; <?= $model->estatus ?></span>

                            <?php } else {

                                ?>

                                <span class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; <?= $model->estatus ?></span>

                            <?php } ?>

                        </dd>

                        <hr>

                        

                    </dl>

                    <hr>

                    <dl class="dl-horizontal">

                        <dt>Identificación:</dt>

                        <dd><?= $model->cedula ?></dd>

                        <dt>Nombres:</dt>

                        <dd><?= $model->nombres ?></dd>

                        <dt>Apellidos:</dt>

                        <dd><?= $model->apellidos ?></dd>

                        <dt>Correo:</dt>

                        <dd><?= $model->correo ?></dd>

                        <dt>ID Biométrico:</dt>

                        <dd><?= $model->idbiometrico ?></dd>

                        <dt>Sucursal:</dt>

                        <dd><?= $model->iddepartamento0->nombre; ?></dd>


                        
                     

                    </dl>

                    <hr>

                    <dl class="dl-horizontal">

                        

                    </dl>

                </div><!-- /.box-body -->

            </div><!-- /.box -->

        </div><!-- ./col -->

        <div class="col-md-6">

            <div class="box box-solid">

                <div class="box-header with-border">

                    <i class="fa fa-info-circle"></i>

                    <h3 class="box-title">Ultimos movimientos</h3>

                </div><!-- /.box-header -->

                <div class="box-body">

                   
                </div><!-- /.box-body -->

            </div><!-- /.box -->

        </div><!-- ./col -->

    </div>



</div>

