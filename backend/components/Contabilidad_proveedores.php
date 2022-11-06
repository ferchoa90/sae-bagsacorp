<?php
namespace backend\components;
use Yii;
use common\models\Proveedores;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 23/02/22
 * Time: 12:08
 */

class Contabilidad_proveedores extends Component
{

    public function getProveedores($objetos)
    {


    }

    public function getSelect()
    {
        $proveedores = Proveedores::find()->where("isDeleted = 0")->orderBy(["nombre" => SORT_ASC])->all();
        //var_dump($proveedores);
        $proveedoresArray=array();
        $cont=0;
        foreach ($proveedores as $key => $value) {
            if ($cont==0){ $proveedoresArray[$cont]["value"]="Seleccione un proveedor"; $proveedoresArray[$cont]["id"]=-1; $cont++; }
            $proveedoresArray[$cont]["value"]=$value->nombre;
            $proveedoresArray[$cont]["id"]=$value->id;
            $cont++;
        }
        return $proveedoresArray;

    }

    public function Nuevo($proveedor)
    {
        //$date = date("Y-m-d H:i:s");
        $result;
        if ($proveedor):
            $model= New Cuentasporcobrar;
            $model->cedula=$proveedor->idfactura;
            $model->razonsocial=$proveedor->idfactura;
            $model->direccion=$proveedor->idfactura;
            $model->telefono=$proveedor->idfactura;
            $model->correo=$proveedor->idfactura;
            $model->tipo=$proveedor->idfactura;
            $model->usuariocreacion=$proveedor->idfactura;

            $model->saldo=$proveedor->idfactura;
            $model->concepto=$proveedor->idfactura;
            $model->diario=$proveedor->idfactura;
            $model->dias=$proveedor->idfactura;

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

    public function ProveedorGuardar($proveedor) {
        $result = (object) [
            'success' => false,
            'id' => 0,
            'message' => 'No se pudo completar la operacion',
            'tipo' => 'error'
          ];
          if ($proveedor) {
              $id = -1;
              if ($proveedor['id']) {
                $id = $proveedor['id'];
              }
              $model = New Proveedores();
              if ($id > 0) {
                $model = Proveedores::findOne(intval($id));
              }
              if ($model != NULL) {
                $model->identificacion = $proveedor['identificacion'];
                $model->natural = $proveedor['natural'] ? 1 : 0;
                $model->cuentacontable = $proveedor['cuentacontable'];
                $model->cuentaanticipo = $proveedor['cuentaanticipo'];
                $model->debito = $proveedor['debito'];
                $model->credito = $proveedor['credito'];
                $model->nombre = $proveedor['nombre'];
                $model->direccion = $proveedor['direccion'];
                $model->correo = $proveedor['correo'];
                $model->notas = $proveedor['notas'];
                $model->contacto = $proveedor['contacto'];
                $model->fax = $proveedor['fax'];
                $model->telefono = $proveedor['telefono'];
                $model->isDeleted = 0;
                $model->estatus = 'ACTIVO';
              }
              
              if ($model->save()) {
                $result->success = true;
                $result->id = $model->id;
                $result->message = 'Los datos se guardaron exitosamente';
                $result->tipo = 'success';
              } else {
                $this->logearError(1, 0, $model->errors);
                $errores = "";
                foreach ($model->errors as $msj) {
                  $errores .= $msj . "\r\n";
                }
                $result->message = $errores;
              }
          }
          return $result;
    }

    public function auditoria(){

    }
}
