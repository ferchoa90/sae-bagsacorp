<?php

namespace backend\components;



use Yii;

use backend\models\User;

use backend\models\Configuracion;

use yii\base\Component;

use yii\base\InvalidConfigException;





/**

 * Created by VSCODE.

 * User: Mario Aguilar

 * Date: 06/09/21

 * Time: 22:22

 */



class Objetos extends Component

{



    public function getObjetosArray($objetos,$return=false)

    {

        $resultado;

        foreach($objetos as $obj):

            //var_dump($objetos);



            switch ($obj['tipo']) {

                case 'input': 

                    $resultado.= $this->getInput($obj['subtipo'],$obj['nombre'], $obj['id'], $obj['valor'], $obj['onchange'], $obj['clase'], $obj['estilo'], $obj['icono'],$obj['boxbody'],$obj['etiqueta'], $obj['col'], $obj['adicional']); 

                    break; 

                    

                case 'separador': 

                    $resultado.= $this->getSeparador($obj['clase'],$obj['estilo'], $obj['color']); 

                    break; 

                default:

                    

                    break;

            }

        endforeach;

        if ($return)

        {

            return $resultado;

        }else{

            echo $resultado;

        }

    }



    public function getInput($tipo, $nombre='', $id='', $valor='', $onchange='', $clase='', $style='', $icono='',$boxbody=false,$etiqueta='', $col='', $adicional)

    {

        //$date = date("Y-m-d H:i:s");

        switch ($tipo) {

            case 'cajatexto':

                return $this->getInputText($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta, $col, $adicional);

                break;

            

            default:

                return "Debe indicar un tipo de Input";

                break;

        }

        return $date;

    }



    private static function getInputText($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta, $col, $adicional)

    {

        $input='';

        $classdefault='form-control pull-right';

        $boxbody='<div class="box-body">';

        $enddiv='</div>';



        switch ($clase) {

            case '':

                $clase=$classdefault;

                break;

            

            default:

                $clase=$clase;

                break;

        }



        switch ($etiqueta) {

            case '':

                $input='<input type="text" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'">';

                break;

                

                default:

                $input='<input type="text" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$etiqueta.'">';

                break;

        }

      

        $resultado='

        <div class="'.$col.'">

            <div class="form-group">

                <label>'.$etiqueta.'</label>

                <div class="input-group mb-3">

                    <div class="input-group-prepend">

                        <span class="input-group-text"><i class="fas fa-edit"></i></span>

                    </div>

                    '.$input.'

                </div>

            </div>

        </div>

       ';

        if ($boxbody):

            $resultado=$boxbody.$resultado.$enddiv;

        endif;

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