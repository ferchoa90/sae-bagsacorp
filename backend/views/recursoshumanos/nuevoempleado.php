<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */
$this->title = 'Crear Empleado';
$this->params['breadcrumbs'][] = ['label' => 'Administración de Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <input type="hidden" id="action" value="create">
    <input type="hidden" id="id" value="0">
    <div class="trivia-head-create">
        <div class="box-body">
            <a class="btn btn-success" id="btn_save"><i class="fa fa-save"></i>&nbsp; Guardar</a>
        </div><br>
        <div class="box-body" id="messages" style="display:none;"></div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-9 col-xs-12">
                    <div class="card card-primary">
                        <div class="card-header with-border">
                            <h3 class="card-title">Configuración de Empleado</h3>
                        </div><!-- /.box-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2" style="width: 100%;" id="estado">
                                            <option selected="selected" value="ACTIVO">Activo</option>
                                            <option value="INACTIVO">Inactivo</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-4">
                                   <div class="form-group">
                                        <label>Departamento</label>
                                        <select class="form-control select2" style="width: 100%;" id="departamento">
                                            <option >seleccione...</option>
                                            <?php $cont=0; foreach ($departamento as $key => $value) { ?>
                                                <option value="<?=$value->id ?>" <?php if($cont==0){ echo 'selected="selected" ';  } ?>  ><?=$value->nombre ?></option>
                                            <?php $cont++; } ?>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                           </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="card card-success">
                        <div class="card-header with-border">
                            <h3 class="card-title">Usuario</h3>
                        </div> 
                        <div class="card-body">
                            <div class="form-group">
                                <label>Creado por: </label>
                                <?= Yii::$app->user->identity->nombres.' '.Yii::$app->user->identity->apellidos ?>
                            </div> 
                        </div> 
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="card card-secondary">
                        <div class="card-header with-border">
                            <h3 class="card-title">Datos</h3>
                        </div><!-- /.box-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-xs-3">
                                    <!-- Date and time range -->
                                    <div class="form-group">
                                        <label>Nombres:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="nombres">
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                </div><!-- /.box-body -->

                                <div class="col-md-3 col-xs-3">
                                    <!-- Date and time range -->
                                    <div class="form-group">
                                        <label>Apellidos:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="apellidos">
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                </div><!-- /.box-body -->
                                <div class="col-md-3 col-xs-3">
                                <!-- Date and time range -->
                                <div class="form-group">
                                        <label>Correo:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-at"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="correo">
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                </div><!-- /.box-body -->
                                <div class="col-md-3 col-xs-3">
                                    <div class="form-group">
                                        <label>ID biometrico:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                            <i class="fa fa-pencil"></i>
                                            </div>
                                            <input type="number" class="form-control pull-right" id="idbio">
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                </div><!-- /.box-body -->                       
                                <div class="col-md-3 col-xs-3">
                                    <!-- Date and time range -->
                                    <div class="form-group">
                                        <label>Cédula:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <input type="number" min="0000000000" max="9999999999" value="9999999999" class="form-control pull-right" id="cedula">
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box-body -->                        
                        </div> 
                    </div><!-- /.box -->
                </div>
                
                
            </div>
        </div>
        <!--<div class="box-body">
            <a class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Guardar</a>
        </div>-->
    </div>
<?php
$this->registerCssFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker-bs3.css", []);
$this->registerJsFile(URL::base() . "/js/plugins/moment.min.js", []);
$this->registerJsFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker.js", []);
$this->registerJsFile(URL::base() . "/js/class/empleadoNew.js", []);
?>