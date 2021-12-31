<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use yii\base\Component;
use yii\web\View;
use backend\assets\AppAsset;
use yii\base\InvalidConfigException;

/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 10/12/21
 * Time: 01:07
 */

class Modal extends Component
{
    public function getModal($tipo,$nombre='', $id='', $titulo='', $content='', $clase='', $style='', $col='',$adicional )
    {
                return $this->getWinmodal($tipo,$nombre, $id, $titulo, $content, $clase, $style, $col,$adicional);
    }

    public function getWinmodal($tipo,$nombre='', $id='', $titulo='',$content='', $clase='', $style='', $col='', $adicional)
    {
        $this->getWrite($nombre,$id,$tipo);
        $classdefault='';
        $tipodefault='fas fa-pencil-alt';
        $tamaniodefault='';
        switch ($tipo) {
            case 'okcancel':
                $tipo='fas fa-pencil-alt';
                break;

            case 'ok':
                $tipo='fas fa-eye';
                break;

            case 'savecancel':
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
        <!-- Modal -->
<div class="modal fade" id="nuevoClienteModal" tabindex="-1" role="dialog" aria-labelledby="nuevoClienteModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">'.$content.'

      </div>
    </div>
  </div>
</div>

        ';

       /* $div='
            <i id="'.$id.'" name="'.$nombre.'" alt="'.$titulo.'" title="'.$titulo.'" class="'.$clase.' '.$tipo.'"></i>
        ';*/
        $resultado=$div;


        //return true;
        return $resultado;
    }

    public function getWrite($name='',$id='', $tipo='')
    {


        $script = <<< JS
            //alert('hola');
            console.log("Prueba");
            function prueba()
            {
            //alert('hola');

            }


JS;



        Yii::$app->getView()->registerJs($script, \yii\web\View::POS_END);

    }
}