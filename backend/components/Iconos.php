<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/09/21
 * Time: 16:16
 */

class Iconos extends Component
{
    public function getIconos($tipo,$nombre='', $id='', $titulo='', $clase='', $style='', $col='',$adicional )
    {
                return $this->getIcono($tipo,$nombre, $id, $titulo, $clase, $style, $col,$adicional);
    }

    private static function getIcono($tipo,$nombre='', $id='', $titulo='', $clase='', $style='', $col='', $adicional)
    {
        $classdefault='';
        $tipodefault='fas fa-pencil-alt';
        $tamaniodefault='';
        switch ($tipo) {
            case 'lapiz':
                $tipo='fas fa-pencil-alt';
                break;

            case 'ver':
                $tipo='fas fa-eye';
                break;

            case 'tacho':
                $tipo='fas fa-trash';
                break;

            case 'eliminar':
                $tipo='fas fa-trash';
                break;

            case 'editar':
                $tipo='fas fa-pencil-alt';
                break;

            case 'ojo':
                $tipo='fas fa-eye';
                break;

            default:
                $tipo=$tipodefault;
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
            <i id="'.$id.'" name="'.$nombre.'" alt="'.$titulo.'" title="'.$titulo.'" class="'.$clase.' '.$tipo.'"></i>
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