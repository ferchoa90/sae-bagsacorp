 <?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;
use yii\web\View;
use backend\assets\AppAsset;

/* @var $this yii\web\View */

$this->title = "Nuevo rol";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

//var_dump($clientes);



 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombrerol', 'id'=>'nombrerol', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'descripcion', 'id'=>'descripcion', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Descripción','leyenda'=>'Descripción del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'modulousuarios', 'id'=>'modulousuarios', 'valor'=>'Usuarios', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-3 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'modulocontable', 'id'=>'modulocontable', 'valor'=>'Contabilidad', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-3 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'modulofacturacion', 'id'=>'modulofacturacion', 'valor'=>'Facturación', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-3 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'moduloinventario', 'id'=>'moduloinventario', 'valor'=>'Inventario', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-3 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'modulorecursosh', 'id'=>'modulorecursosh', 'valor'=>'R. Humanos', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-3 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'moduloreportes', 'id'=>'moduloreportes', 'valor'=>'Reportes', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-3 col-md-3', 'adicional'=>''),
        

    ),true
);
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-9 col-xs-12 ','','','','');
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-3 col-xs-12 ','','','','');
 //echo $contenido;
 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));


 $contenido2='<div style="line-height:25px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ACTIVO</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>

 