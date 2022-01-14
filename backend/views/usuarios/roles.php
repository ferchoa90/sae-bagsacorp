 <?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Navs;
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
$nav= new Navs;
$div= new Bloques;

//var_dump($clientes);
//$contenidotab='';
$modulousuario=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agusuario', 'id'=>'agusuario', 'valor'=>'Agregar Usu', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edusuario', 'id'=>'edusuario', 'valor'=>'Editar Usu', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eliusuario', 'id'=>'eliusuario', 'valor'=>'Eliminar Usu', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agroles', 'id'=>'agroles', 'valor'=>'Agregar Rol', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edroles', 'id'=>'edroles', 'valor'=>'Editar Rol', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eliroles', 'id'=>'eliroles', 'valor'=>'Eliminar Rol', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        //array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'repusuario', 'id'=>'repusuario', 'valor'=>'Reportes', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
    ),true
);

$modulocontabilidad=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agcxc', 'id'=>'agcxc', 'valor'=>'Agregar CXC', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edcxc', 'id'=>'edcxc', 'valor'=>'Editar CXC', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elicxc', 'id'=>'elicxc', 'valor'=>'Eliminar CXC', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agcxp', 'id'=>'agcxp', 'valor'=>'Agregar CPC', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edcxp', 'id'=>'edcxp', 'valor'=>'Editar CPC', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elicxp', 'id'=>'elicxp', 'valor'=>'Eliminar CPC', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agdiario', 'id'=>'agdiario', 'valor'=>'Agregar Diario', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eddiario', 'id'=>'eddiario', 'valor'=>'Editar Diario', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elidiario', 'id'=>'elidiario', 'valor'=>'Eliminar Diario', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agperiodo', 'id'=>'agperiodo', 'valor'=>'Agregar Periodo', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edperiodo', 'id'=>'edperiodo', 'valor'=>'Editar Periodo', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eliperiodo', 'id'=>'eliperiodo', 'valor'=>'Eliminar Periodo', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elidiario', 'id'=>'elidiario', 'valor'=>'Eliminar Diario', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agdeclaraciones', 'id'=>'agdeclaraciones', 'valor'=>'Agregar Declaraciones', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eddeclaraciones', 'id'=>'eddeclaraciones', 'valor'=>'Editar Declaraciones', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elideclaraciones', 'id'=>'elideclaraciones', 'valor'=>'Eliminar Declaraciones', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        
    ),true
);

$modulofacturacion=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agfacturacion', 'id'=>'agfacturacion', 'valor'=>'Agregar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edfacturacion', 'id'=>'edfacturacion', 'valor'=>'Editar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elifacturacion', 'id'=>'elifacturacion', 'valor'=>'Eliminar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'repfacturacion', 'id'=>'repfacturacion', 'valor'=>'Reportes', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
    ),true
);

$moduloinventario=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'aginventario', 'id'=>'aginventario', 'valor'=>'Agregar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edinventario', 'id'=>'edinventario', 'valor'=>'Editar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eliinventario', 'id'=>'eliinventario', 'valor'=>'Eliminar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'repinventario', 'id'=>'repinventario', 'valor'=>'Reportes', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
    ),true
);

$modulorecursosh=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agrecursosh', 'id'=>'agrecursosh', 'valor'=>'Agregar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edrecursosh', 'id'=>'edrecursosh', 'valor'=>'Editar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elirecursosh', 'id'=>'elirecursosh', 'valor'=>'Eliminar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'reprecursosh', 'id'=>'reprecursosh', 'valor'=>'Reportes', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
    ),true
);

$moduloreportes=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agreportes', 'id'=>'agreportes', 'valor'=>'Agregar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edreportes', 'id'=>'edreportes', 'valor'=>'Editar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elireportes', 'id'=>'elireportes', 'valor'=>'Eliminar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'repreportes', 'id'=>'repreportes', 'valor'=>'Reportes', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>''),
    ),true
);


$contenidotab=$nav->getNavsarray(
    array(
        array('tipo'=>'config','nombre'=>'tabpermisos', 'id'=>'tabpermisos', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'tab','nombre'=>'usuarios', 'id'=>'usuarios', 'titulo'=>'Usuarios', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$modulousuario),
        array('tipo'=>'tab','nombre'=>'contabilidad', 'id'=>'contabilidad', 'titulo'=>'Contabilidad', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$modulocontabilidad),
    )
);


 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombrerol', 'id'=>'nombrerol', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'descripcion', 'id'=>'descripcion', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Descripción','leyenda'=>'Descripción del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'modulousuarios', 'id'=>'modulousuarios', 'valor'=>'Usuarios', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'modulocontable', 'id'=>'modulocontable', 'valor'=>'Contabilidad', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'modulofacturacion', 'id'=>'modulofacturacion', 'valor'=>'Facturación', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'moduloinventario', 'id'=>'moduloinventario', 'valor'=>'Inventario', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'modulorecursosh', 'id'=>'modulorecursosh', 'valor'=>'R. Humanos', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'moduloreportes', 'id'=>'moduloreportes', 'valor'=>'Reportes', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
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
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$contenidotab.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>



 