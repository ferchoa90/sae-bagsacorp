<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use backend\models\Cuentasporcobrar;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 21/12/21
 * Time: 12:08
 */

class Contabilidad_clientes extends Component
{

    public function getCuentasporcobrar($objetos)
    {


    }

    public function Nuevo($cliente)
    {
        //$date = date("Y-m-d H:i:s");
        $result;
        if ($cliente):
            $model= New Cuentasporcobrar;
            $model->cedula=$cliente->idfactura;
            $model->razonsocial=$cliente->idfactura;
            $model->direccion=$cliente->idfactura;
            $model->telefono=$cliente->idfactura;
            $model->correo=$cliente->idfactura;
            $model->tipo=$cliente->idfactura;
            $model->usuariocreacion=$cliente->idfactura;

            $model->saldo=$cliente->idfactura;
            $model->concepto=$cliente->idfactura;
            $model->diario=$cliente->idfactura;
            $model->dias=$cliente->idfactura;

            $model->isDeleted=0;
            $model->estatus="ACTIVO";

            if ($model->save()):
                return $model->id;
            else:

            endif;
        else:
            $result=false;
        endif;
        return $date;
    }

    public function auditoria(){

    }
}
