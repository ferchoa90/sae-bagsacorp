<?php
use backend\components\Objetos;
use backend\components\Bloques;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Administración de Marcajes";
$this->params['breadcrumbs'][] = $this->title;
 

$objeto= new Objetos;
$div= new Bloques;
 echo $objeto->getInput('cajatexto','prueba','prueba','','','','','lapiz',true,'Nombre: ','col-3','');
 //echo $objeto->getInput('cajatexto','prueba','prueba','','','','','lapiz',true,'Nombre: ','col-3','');
 /*echo $objeto->getObjetosArray(
     array( 
         array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''), 
         array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'prueba', 'id'=>'prueba', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre: ', 'col'=>'col-3', 'adicional'=>''),
         array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
         array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'prueba', 'id'=>'prueba', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre: ', 'col'=>'col-3', 'adicional'=>''),
     )
 );
*/
 $contenido=$objeto->getObjetosArray(
    array( 
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'prueba', 'id'=>'prueba', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre: ', 'col'=>'col-3', 'adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''), 
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'prueba', 'id'=>'prueba', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre: ', 'col'=>'col-3', 'adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
    ),true
);
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-9 col-xs-12 ','','','','');
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-3 col-xs-12 ','','','','');
 //echo $contenido;
 echo $div->getBloqueArray(
    array( 
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'PRUEBA','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido),
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'2','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>''),
    )
);

//var_dump($objeto);
?>



