<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;
use backend\components\Iconos;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/09/21
 * Time: 16:16
 */

class Botones extends Component
{

    public function getBotongridArray($objetos)
    {

        $result;
        foreach($objetos as $obj):


            switch ($obj['tipo']) {
                case 'link':
                    $return.=$this->getBoton($obj['nombre'],$obj['id'],$obj['titulo'],$obj['link'],$obj['onclick'],$obj['clase'],$obj['style'],$obj['col'],$obj['tipocolor'],$obj['icono'],$obj['tamanio'],$obj['adicional']);
                    break;

                case 'separador':
                    //echo $this->getSeparador($obj['clase'],$obj['estilo'], $obj['color']);
                    break;
                default:

                    break;
            }
        endforeach;
        return $return;
    }

    public function getBotones($tipo, $nombre='', $id='', $titulo='', $link='', $onclick='', $clase='', $style='', $col='',$tipocolor='',$icono='',$tamanio='', $adicional )
    {
        //$date = date("Y-m-d H:i:s");
        switch ($tipo) {
            case 'bloquediv':
                return $this->getBoton($nombre, $id, $titulo, $link,$onclick ,$clase, $style, $col,$tipocolor,$icono,$tamanio='', $adicional);
                break;

            default:
                return "Debe indicar un tipo de bloque";
                break;
        }
        return $date;
    }

    private function getBoton($nombre='', $id='', $titulo='', $link='', $onclick='', $clase='', $style='', $col='',$tipocolor='',$icono='',$tamanio='', $adicional)
    {
        $classdefault=' ';
        $tipocolordefault='btn btn-primary';
        $tamaniodefault='btn-sm';
        $onclickdefault='';
        $linkdefault='';

        ($tamanio=='') ? $tamanio=$tamaniodefault : '' ;
        ($tamanio=='pequeño') ? $tamanio='btn-sm' : '' ;
        ($tamanio=='grande') ? $tamanio='btn-large' : '' ;
        ($tamanio=='completo') ? $tamanio='btn-block' : '' ;



        ($link=='') ? $link=$linkdefault : $link='href="'.$link.'"' ;

        ($onclick=='') ? $onclick=$onclickdefault : $onclick='javascript:'.$onclick.';' ;
        ($onclick=='') ? $onclick=$onclickdefault : $link='' ;

        $icon = new Iconos;
        //var_dump($icono);
        $icono= $icon->getIconos($icono,'','','','','','','');


        switch ($tipocolor) {
            case 'azul':
                $tipocolor='btn btn-primary btnedit';
                break;

            case 'verde':
                $tipocolor='btn btn-success btnedit';
                break;

            case 'rojo':
                $tipocolor='btn btn-danger btnedit';
                break;

            case 'verdesuave':
                $tipocolor='btn btn-info btnedit';
                break;

            case 'amarillo':
                $tipocolor='btn btn-warning btnedit';
                break;

            case 'plomo':
                $tipocolor='btn btn-secondary btnedit';
                break;

            default:
                $tipocolor=$tipocolordefault;
                break;
        }

        switch ($clase) {
            case !'':
                $clase=$clase;
                break;

            default:
                $clase=$classdefault;
                break;
        }



        $div='
         <a  '.$link.'  class="'.$clase.'" onclick="'.$onclick.'">
                    <button type="submit" id="'.$id.'" name="'.$nombre.'" alt="'.$titulo.'" title="'.$titulo.'" onclick="" class="'.$tipocolor.' '.$tamanio.'">
                    '.$icono.'
                    </button>
        </a>
        ';
        $resultado=$div;
        return $resultado;
    }

    public function getSeparador($clase='',$estilo='', $color='')
    {
        switch ($color) {
            case !'':
                return '<hr style="color: '.$color.'" />';
                break;

            default:
                return '<hr style="color: #0056b2;" />';
                break;
        }
    }


}