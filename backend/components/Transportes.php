<?php
namespace backend\components;

use common\models\Operarios as ModeloOperario;
use common\models\Transporte;
use Yii;
use yii\base\Component;

class Transportes extends Component {
  
  private const MODULO = 'MANTENIMIENTO - TRANSPORTE';

  public function TransporteGuardar($transporte) {
    $result = (object) [
        'success' => false,
        'id' => 0,
        'message' => 'No se pudo completar la operacion',
        'tipo' => 'error'
      ];
      if ($transporte) {
          $id = -1;
          if ($transporte['id']) {
            $id = $transporte['id'];
          }
          $model = new Transporte();
          if ($id > 0) {
            $model = Transporte::findOne(intval($id));
          }
          if ($model != NULL) {            
            $model->nombre = $transporte['nombre'];
            $model->contacto = $transporte['contacto'];
            $model->direccion = $transporte['direccion'];
            $model->observaciones = $transporte['observaciones'];
            $model->observaciones = $transporte['telefono'];
            $model->ruc = $transporte['ruc'];
            $model->placa = $transporte['placa'];
            $model->telefonos = $transporte['telefonos'];
            $model->fechacreacion = date_format(date_create(), "Y-m-d");
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

  private function logearError($id, $error, $observacion) {
    $log = new Log_errores;
    $observacion = "ID: " . $id;
    $log->Nuevo(self::MODULO." ",$error, $observacion, 0, Yii::$app->user->identity->id);
  }
}