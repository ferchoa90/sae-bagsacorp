<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Mi perfil';
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
    <input type="hidden" id="action" value="create">
    <input type="hidden" id="id" value="0">
    <div class="trivia-head-create">
        <div class="box-body">
            <a class="btn btn-success" id="btn_save"><i class="fa fa-save"></i></a>
        </div>
        <br>
        <div class="box-body" id="messages" style="display:none;"></div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-9 col-xs-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Configuración de Usuario</h3>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2" style="width: 100%;" id="estado">
                                            <option selected="selected" value="ACTIVE">Activo</option>
                                            <option value="INACTIVE">Inactivo</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Perfil de Usuario</label>
                                        <select class="form-control select2" style="width: 100%;" id="tipo">
                                                <option selected="selected" value="Administrador">Administrador</option>
                                            <option value="Usuario">Usuario</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="card card-success">
                        <div class="card-header">
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
                        <div class="card-header">
                            <h3 class="card-title">Datos</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <!-- Date and time range -->
                                    <div class="form-group">
                                        <label>Nombres:</label>
    
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Nombres" id="nombres" value="<?= Yii::$app->user->identity->nombres ?>">
                                        </div>
                                    </div><!-- /.form group -->
                                </div><!-- /.box-body -->
                                <div class="col-md-6 col-xs-6">
                                    <!-- Date and time range -->
                                    <div class="form-group">
                                        <label>Apellidos:</label>
 
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Apellidos" value="<?= Yii::$app->user->identity->apellidos ?>" id="apellidos">
                                        </div>
                                    </div><!-- /.form group -->
                                </div><!-- /.box-body -->
                                <div class="col-md-6 col-xs-6">
                                    <!-- Date and time range -->
                                    <div class="form-group">
                                        <label>Nombre de Usuario:</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">@</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Username"  id="nusuario"  value="<?= Yii::$app->user->identity->username ?>">
                                        </div>

                                        
                                        
                                    </div><!-- /.form group -->
                                </div><!-- /.box-body -->
                                <div class="col-md-6 col-xs-6">
                                    <!-- Date and time range -->
                                    <div class="form-group">
                                        <label>Contraseña:</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="contraseña" id="contrasenia"  value="<?= Yii::$app->user->identity->password_hash ?>">
                                        </div>
   
                                    </div><!-- /.form group -->
                                </div><!-- /.box-body -->
                                <div class="col-md-6 col-xs-6">
                                      
                                            <!-- Date and time range -->
                                            <div class="form-group">
                                                <label>Correo:</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <input type="email" class="form-control" placeholder="Email" id="correo"  value="<?= Yii::$app->user->identity->email ?>">
                                                </div>
                                                
                                            </div><!-- /.form group -->
                             
                        </div>
                     </div>
                    </div><!-- /.box -->
                </div>
               
            </div>


            <!-- Trivia Detalle -->

            <div class="row" id="opciones" style="display: none;">
                <div class="col-md-12 col-xs-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Opciones de respuesta</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-10 col-xs-8">
                                    <label>Opciones:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                        <input type="text" class="form-control pull-right opcion">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-2 col-xs-4">
                                    <label>Orden:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                        <input type="text" class="form-control pull-right orden">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <div class="row">
                                <div class="col-md-10  col-xs-8">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                        <input type="text" class="form-control pull-right opcion">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-2  col-xs-4">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                        <input type="text" class="form-control pull-right orden">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <div class="row">
                                <div class="col-md-10 col-xs-8">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                        <input type="text" class="form-control pull-right opcion">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-2 col-xs-4">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                        <input type="text" class="form-control pull-right orden">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <div class="row">
                                <div class="col-md-10 col-xs-8">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                        <input type="text" class="form-control pull-right opcion">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-2 col-xs-4">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                        <input type="text" class="form-control pull-right orden">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
        </div>
        </div>
        <!--<div class="box-body">
            <a class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Guardar</a>
        </div>-->
    </div>

<?php
$this->registerCssFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker-bs3.css", [
   // 'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);
$this->registerJsFile(URL::base() . "/js/plugins/moment.min.js", [
   // 'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);
$this->registerJsFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker.js", [
   // 'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);
$this->registerJsFile(URL::base() . "/js/class/triviaCreate.js", [
   // 'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);
