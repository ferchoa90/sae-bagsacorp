<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Administración de Empleados";
$this->params['breadcrumbs'][] = $this->title;

$flagIndex = 'false';

if (strpos($_SERVER['REQUEST_URI'], 'index') !== false) {
    $flagIndex = 'true';
}

$urls = explode("/", str_replace('/index', '', $_SERVER['REQUEST_URI']));
$partes = count($urls) - 1;

?>
    <!-- ========================================================================================================== -->
    <!-- Trvia box -->
    <input type="hidden" id="urlflag" value="<?= $flagIndex ?>">
    <input type="hidden" id="urlself" value="<?= $urls[$partes] ?>">
    <input type="hidden" id="token" value="<?= Yii::$app->request->getCsrfToken() ?>">
    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-plus','title'=>'Nuevo Empleado']) . '', ['nuevoempleado'], ['class' => 'btn btn-primary','title'=>'Nuevo Empleado']) ?>
<br>
<br>
<div class="card">
        <div class="card-body">
            <div class="card-body">
                <table id="table" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="tableheader">
                        <th>#</th>
                        <th>Cédula</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Id Bio</th>
                        <th>Departamento</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>T. Sangre</th>
                        <th>Nacionalidad</th>
                        <th>Fecha I.</th>
                        <th>Fecha S.</th>
                        <th>Usuario Creación</th>
                        <th>Fecha Creación</th>
                        <th>Estado</th>
                        <th>&nbsp;Acciones&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
<?php
$this->registerJsFile(URL::base() . "/js/class/empleadosAdmin.js");