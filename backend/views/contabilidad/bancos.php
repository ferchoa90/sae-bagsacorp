<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Administración de Bancos";
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
    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-plus']) . '&nbsp; Agregar Banco', ['nuevobanco'], ['class' => 'btn btn-primary']) ?>
<br>
<br>
    <div class="box">
        <div class="box-body">
            <div class="box-body">
                <table id="table_slider" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="tableheader">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
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
$this->registerJsFile(URL::base() . "/js/class/ContabilidadBancosAdmin.js", ['depends' => [ \yii\bootstrap\BootstrapPluginAsset::className()]
]);