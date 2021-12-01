<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */
$this->title = 'Reporte de Tickets';
$this->params['breadcrumbs'][] = ['label' => 'Reportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= URL::base() ?>/js/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- Theme style -->
   <!-- <link rel="stylesheet" href="<?= URL::base() ?>/dist/css/adminlte.min.css"> -->
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary ">
                <div class="box-header ">
                <h3 class="box-title">Parámetros de reporte</h3>
                </div>
                <div class="box-body">
                <!-- Date -->
                <form id="frmfiltro" name="frmfiltro" action="<?= URL::base() ?>/reportes/tickets" method="post" style="    align-items: center; display:flex">
                        <div class="col-md-3" data-select2-id="14">
                            <div class="form-group" data-select2-id="13">
                            <label>DEPARTAMENTO</label>
                            <select class="form-control select2 select2-hidden-accessible" name="departamento"  style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option selected="selected" data-select2-id="1">TODOS</option>
                                <?php $cont=0; foreach ($departamentos as $key => $value) { ?>
                                    <option <?php if ($value->id==@$_COOKIE["departamento"]){ echo 'selected="selected"'; } ?>  value="<?=$value->id ?>" ><?=$value->nombre ?></option>
                                <?php $cont++; } ?>
                                
                            </select>
                            </div>
                            <!-- /.form-group -->
                                </div>
                                <div class="col-md-3" data-select2-id="14">
                            <div class="form-group">
                            <label>SERVICIO</label>
                            <select class="form-control select2 select2-hidden-accessible" name="servicio"  style="width: 100%;" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                <option selected="selected" data-select2-id="2"  value="0">TODOS</option>
                                <?php $cont=0; foreach ($horarios as $key => $value) { ?>
                                    <option <?php if ($value->id==@$_COOKIE["servicio"]){ echo 'selected="selected"'; } ?> value="<?=$value->id ?>" ><?=$value->nombre ?></option>
                                <?php $cont++; } ?>
                            </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        

                    <div class="col-md-2">
                        <div class="form-group">
                            
                            <label>Fecha inicio:</label>
                            <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" autocomplete="off" class="form-control pull-right" id="fechadesde" name="fechadesde" value="<?=@$fechadesde?>">
                            </div>
                            <!-- /.input group -->
                            
                        </div>

                        <!-- /.form group -->
                    </div>
                     <!-- Date -->
                     <div class="col-md-2">
                        <div class="form-group">
                            <label>Fecha Final:</label>
                            <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" autocomplete="off" class="form-control pull-right" id="fechahasta" name="fechahasta" value="<?=@$fechahasta?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                    </div>
                    <div class="col-md-1  text-right align-items-center  align-items-center vcenter" >
                    <div class="col-md-12  text-right align-items-center d-flex align-items-center vcenter" >
                    <input type="hidden" id="_csrf-backend"  name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">
                    <button type="submit" class="btn btn-primary align-middle">Aplicar</button>
                    </div>
                    </div>
                    </form>
                </div>

        </div>
    </div>

<div class="col-md-12" >
    <div class="box box-primary ">
    <div class="row col-md-12"  >
        <div class=" text-right" style="padding:1%;" >
            <?=$exportmenu?>     
        </div>
        
    </div>
    <div class="row col-md-12"  >
        <?=$gridview?>     
        </div>
    </div>
</div>

</div>

<script type="text/javascript">
  $('#fechadesde').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd-mm-yyyy',
    changeMonth: true,
    changeYear: false,

     
  });
  $('#fechahasta').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd-mm-yyyy',
    changeMonth: true,
    changeYear: false,
  });

  //$('#fechahasta').value('20-07-2021');
</script>

<style>
.summary
{
    padding-left: 1%;
}
</style>