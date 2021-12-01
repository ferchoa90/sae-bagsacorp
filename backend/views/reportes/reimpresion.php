<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Impresión de tickets";
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

    <div class="box">
        <div class="box-body">
            <div class="box-body">
                <table id="table" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="tableheader">
                        <th>#</th>
                        <th>Ticket</th>
                        <th>Empleado</th>
                        <th>Departamento</th>
                        <th>Tipo Ser.</th>
                        <th>Fecha marcación</th>
                        
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
<?php
$this->registerJsFile(URL::base() . "/js/class/reportesreimpresionAdmin.js", ['depends' => [ \yii\bootstrap\BootstrapPluginAsset::className()]
]);