<?php



use yii\helpers\Html;

use yii\helpers\Url;

use yii\web\View;
/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Crear Departamento';
$this->params['breadcrumbs'][] = ['label' => 'Administración de Departamento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
    <input type="hidden" id="action" value="nuevo">
    
    <input type="hidden" id="id" value="0">
    <div class="trivia-head-create">
        <div class="box-body">
            <a class="btn btn-success" id="btn_save"><i class="fa fa-save"></i></a>
        </div>
        <br>
        <div class="box-body" id="messages" style="display:none;"></div>
        <form class="" method="POST" id="formSlider" enctype="multipart/form-data">
        <div class="box-body">
            <div class="row">
                <div class="col-md-9 col-xs-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Configuración de departamento</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2" style="width: 100%;" id="estado">
                                            <option selected="selected" value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
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
                <div class="col-md-6 col-xs-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Datos</h3>
                        </div>
                        <div class="card-body">
                            <!-- Date and time range -->
                            
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Nombre:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nombre" id="nombre" name="nombre">
                                </div>
                             
                            </div><!-- /.form group -->
                       
                            <input type="hidden" id="token" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">
                            
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
        </div>
        </form>
        <!--<div class="box-body">
            <a class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Guardar</a>
        </div>-->
    </div>
<?php
$this->registerCssFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker-bs3.css", []);

$this->registerJsFile(URL::base() . "/js/plugins/moment.min.js", []);

$this->registerJsFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker.js", []);

$this->registerJsFile(URL::base() . "/js/class/recursoshdepartamentoNew.js", []);



