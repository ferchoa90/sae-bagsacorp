<?php
namespace backend\components;

use Yii;
use backend\models\User;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;
use backend\components\Iconos;

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
          //  var_dump($objetos);

            switch ($obj['tipo']) {
                case 'input':
                    $resultado.= $this->getInput($obj['subtipo'],$obj['nombre'], $obj['id'], $obj['valor'], $obj['onchange'], $obj['clase'], $obj['estilo'], $obj['icono'],$obj['boxbody'],$obj['etiqueta'],$obj['leyenda'], $obj['col'], $obj['adicional']);
                    break;

            case 'select':
                $resultado.= $this->getSelect($obj['subtipo'],$obj['nombre'], $obj['id'], $obj['valor'], $obj['onchange'], $obj['clase'], $obj['estilo'], $obj['icono'],$obj['boxbody'],$obj['etiqueta'],$obj['leyenda'], $obj['col'], $obj['adicional']);
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
            $boxrow='<div class="row">';
            $endrow='</div>';
            return $boxrow.$resultado.$endrow;
        }else{
            echo $resultado;
        }
    }

    public function getInput($tipo, $nombre='', $id='', $valor='', $onchange='', $clase='', $style='', $icono='',$boxbody=false,$etiqueta='',$leyenda='', $col='', $adicional)
    {
        //$date = date("Y-m-d H:i:s");
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        switch ($tipo) {
            case 'cajatexto':
                return $this->getInputText($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional);
                break;

            case 'numero':
                return $this->getInputNumber($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional);
                break;

            case 'moneda':
                return $this->getInputMoney($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional);
                break;

            case 'fecha':
                return $this->getInputDate($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional);
                break;

            case 'textarea':
                return $this->getInputTextarea($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional);
                break;

            default:
                return "Debe indicar un tipo de Input";
                break;
        }
        return $date;
    }
    public function getSelect($tipo, $nombre='', $id='', $valor=NULL, $onchange='', $clase='', $style='', $icono='',$boxbody=false,$etiqueta='',$leyenda='', $col='', $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
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
                $select='<select class="'.$clase.'" id="'.$id.'" name="'.$nombre.'">';
                break;

                default:
                $select='<select class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$etiqueta.'">';
                break;
        }
        $selectvalue+='<option>'.$etiqueta.'</option>';
      foreach ($valor as $key => $value) {
          $selectvalue.='<option value="'.$value["id"].'">'.$value["value"].'</option>';

      }

        $resultado='
        <div class="'.$col.'">
            <div class="form-group">
                <label>'.$etiqueta.'</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                    </div>
                    '.$select.$selectvalue.'</select>
                </div>
            </div>
        </div>
       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

    private static function getInputText($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$clase;
                break;
        }

        switch ($leyenda) {
            case '':
                $input='<input type="text" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'">';
                break;

                default:
                $input='<input type="text" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$leyenda.'">';
                break;
        }



        $resultado='
        <div class="'.$col.'">
            <div class="form-group">
                <label>'.$etiqueta.'</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                    </div>
                    '.$input.'
                </div>
            </div>
        </div>
       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

    private static function getInputNumber($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$clase;
                break;
        }

        switch ($leyenda) {
            case '':
                $input='<input type="number"  class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'">';
                break;

                default:
                $input='<input type="number" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$leyenda.'">';
                break;
        }

        $resultado='
        <div class="'.$col.'">
            <div class="form-group">
                <label>'.$etiqueta.'</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                    </div>
                    '.$input.'
                </div>
            </div>
        </div>
       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

    private static function getInputMoney($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$clase;
                break;
        }

        switch ($leyenda) {
            case '':
                $input='<input type="number"  min="0" step="0.01" data-number-to-fixed="2" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'">';
                break;

                default:
                $input='<input type="number" min="0" step="0.01" data-number-to-fixed="2" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$leyenda.'">';
                break;
        }

        $resultado='
        <div class="'.$col.'">
            <div class="form-group">
                <label>'.$etiqueta.'</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                    </div>
                    '.$input.'
                </div>
            </div>
        </div>
       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

    private static function getInputTextarea($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
        {
            $iconfa=new Iconos;
            $iconfa= $iconfa->getIconofa($icono);
            $input='';
            $classdefault='form-control pull-right';
            $boxbodydefault='<div class="box-body">';
            $enddiv='</div>';

            switch ($clase) {
                case '':
                    $clase=$classdefault;
                    break;

                default:
                    $clase=$clase;
                    break;
            }

            switch ($leyenda) {
                case '':
                    $input='<textarea class="'.$clase.'"  id="'.$id.'" name="'.$nombre.'"  rows="3">'.$valor.'</textarea>';
                    break;

                    default:
                    $input='<textarea class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$leyenda.'">'.$valor.'</textarea>';
                    break;
            }

            $resultado='
            <div class="'.$col.'">
                <div class="form-group">
                    <label>'.$etiqueta.'</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                        </div>
                        '.$input.'
                    </div>
                </div>
            </div>
        ';
            if ($boxbody):
                $resultado=$boxbodydefault.$resultado.$enddiv;
            else:
                //$resultado=$bo$resultado.$enddiv;
            endif;
            return $resultado;

        }
    private static function getInputDate($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$clase;
                break;
        }

        switch ($leyenda) {
            case '':
                $input='<input type="date" data-provide="datepicker" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'">';
                break;

                default:
                $input='<input type="date" data-provide="datepicker" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$leyenda.'">';
                break;
        }

        $resultado='
        <div class="'.$col.'">
            <div class="form-group">
                <label>'.$etiqueta.'</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                    </div>
                    '.$input.'
                </div>
            </div>
        </div>



       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

    public function getSeparador($clase='',$estilo='', $color='')
    {
        switch ($color) {
            case !'':
                return '<div class="col-12"><hr style="color: '.$color.'" /></div>';
                break;

            default:
                return '<div class="col-12"><hr style="color: #0056b2;" /></div>';
                break;
        }

    }


}