<?php
namespace backend\components;

use common\models\Operarios as ModeloOperario;
use Yii;
use yii\base\Component;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 23/02/22
 * Time: 12:08
 */

class Operarios extends Component {
  
  private const MODULO = 'MANTENIMIENTO - OPERARIOS';

  public function OperarioGuardar($operario) {
    $result = (object) [
        'success' => false,
        'id' => 0,
        'message' => 'No se pudo completar la operacion',
        'tipo' => 'error'
      ];
      if ($operario) {
          $id = -1;
          if ($operario['id']) {
            $id = $operario['id'];
          }
          $model = new ModeloOperario();
          if ($id > 0) {
            $model = ModeloOperario::findOne(intval($id));
          }
          if ($model != NULL) {            
            $model->nombre = $operario['nombre'];
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