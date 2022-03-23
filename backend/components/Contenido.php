<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 06/09/21
 * Time: 22:22
 */

class Contenido extends Component
{

    public function getContenidoArray($objetos)
    {
        echo '<div class="row" style="line-height:30px;">';
        foreach($objetos as $obj):
            //var_dump($objetos);

            switch ($obj['tipo']) {
                case 'div':
                    echo $this->getDiv($obj['nombre'],$obj['id'],$obj['titulo'],$obj['clase'],$obj['style'],$obj['col'],$obj['tipocolor'],$obj['adicional'],$obj['contenido']);
                    break;

                case 'separador':
                    echo $this->getSeparador($obj['clase'],$obj['estilo'], $obj['color']);
                    break;
                default:

                    break;
            }

        endforeach;
        echo '</div>';
    }

    public function getContenidoArrayr($objetos)
    {
        $contenido="";
        $init='<div class="row"  style="line-height:30px;">';
        foreach($objetos as $obj):
            //var_dump($objetos);

            switch ($obj['tipo']) {
                case 'div':
                    $contenido.= $this->getDiv($obj['nombre'],$obj['id'],$obj['titulo'],$obj['clase'],$obj['style'],$obj['col'],$obj['tipocolor'],$obj['adicional'],$obj['contenido']);
                    break;

                case 'separador':
                    $contenido.= '</div>'.$this->getSeparador($obj['clase'],$obj['estilo'], $obj['color']).$init;
                    break;
                default:

                    break;
            }

        endforeach;
        $contenidofinal=$init.$contenido.'</div>';
        return $contenidofinal;
    }

    private static function getDiv($nombre='', $id='', $titulo='', $clase='', $style='', $col='',$tipocolor='', $adicional,$contenido='')
    {
        $classdefault='';
        $tipocolordefault='card card-primary';

        switch ($tipocolor) {
            case 'azul':
                $tipocolor='card card-primary';
                break;

            case 'verde':
                $tipocolor='card card-success';
                break;

            case 'rojo':
                $tipocolor='card card-danger';
                break;

            case 'verdesuave':
                $tipocolor='card card-info';
                break;

            case 'amarillo':
                $tipocolor='card card-warning';
                break;

            case 'plomo' || 'gris':
                $tipocolor='card card-secondary';
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

        $div='<div id="div-'.$clase.'" name="div-'.$clase.'" class="'.$clase.' '.$col.'"><b>'.$titulo.' </b> '.$contenido.'</div>';
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
                return '<hr  style="color: #0056b2;" />';
                break;
        }
    }
}