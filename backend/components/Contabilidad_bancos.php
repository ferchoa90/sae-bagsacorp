<?php
namespace backend\components;

use Yii;
use yii\base\Component;
use common\models\Banco;
use backend\components\Log_errores;

class Contabilidad_bancos extends Component
{
  private const MODULO = 'CONTABILIDAD - BANCOS-MOV';

  public function BancoMovNuevo($bancomov) {
    $result = (object) [
      'success' => false,
      'id' => 0,
      'message' => 'No se pudo completar la operacion',
      'tipo' => 'error'
    ];
    if ($bancomov) {
        $model= New Banco();
        $model->tipo = $bancomov['tipo'];
        $model->referencia = $bancomov['referencia'];
        $model->fecha = $bancomov['fecha'];
        $model->diario = $bancomov['diario'];
        $model->cuenta = $bancomov['cuenta'];
        $model->numeroretencion = $bancomov['numeroretencion'];
        $model->beneficiario = $bancomov['beneficiario'];
        $model->concepto = $bancomov['concepto'];
        $model->valor = $bancomov['valor'];
        $model->tipopago = $bancomov['tipopago'];

        $model->isDeleted = 0;
        $model->estatus = 'ACTIVO';

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
