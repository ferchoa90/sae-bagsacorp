<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "caja".
 *
 * @property int $id
 * @property resource $referencia
 * @property string|null $fecha
 * @property int|null $tipo
 * @property float $valor
 * @property int|null $proveedor
 * @property resource|null $beneficiario
 * @property int|null $tipopago
 * @property resource|null $concepto
 * @property string|null $cuenta
 * @property int|null $cartera
 * @property int|null $comprobante
 * @property string|null $disponible
 * @property string|null $diario
 * @property string|null $numeroretencion
 * @property int|null $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioan
 * @property string|null $fechaan
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property int|null $cuentaxpagar
 * @property string|null $cuentaotros
 * @property string|null $cuentabanco
 * @property int|null $movimientobanco
 * @property int|null $cierrecaja
 * @property int|null $movcaja
 * @property int|null $movcartera
 * @property int|null $movanticipo
 * @property string|null $cuentaempleado
 * @property int|null $movprestamo
 * @property int|null $movingreempl
 * @property int|null $movrol
 * @property int|null $comprobantectaxp
 * @property int|null $usuarioapertura
 * @property string|null $fechaapertura
 * @property int|null $anticipoestatus
 * @property int|null $anticipomov
 * @property string|null $anticipofecha
 * @property int|null $anticipousuario
 * @property int|null $cierreventanum
 * @property string|null $cierreventafecha
 * @property int|null $cierreventausu
 * @property string|null $aperturaventafecha
 * @property int|null $aperturaventausu
 * @property int|null $movrecsocio
 * @property int|null $descsociocuotas
 * @property int|null $recsocmovdebito
 * @property int|null $isDeleted
 * @property string $estatus
 */
class Caja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'caja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['referencia'], 'required'],
            [['referencia', 'beneficiario', 'concepto', 'estatus'], 'string'],
            [['fecha', 'disponible', 'fechacreacion', 'fechaan', 'fechaact', 'fechaapertura', 'anticipofecha', 'cierreventafecha', 'aperturaventafecha'], 'safe'],
            [['tipo', 'proveedor', 'tipopago', 'cartera', 'comprobante', 'usuariocreacion', 'usuarioan', 'usuarioact', 'cuentaxpagar', 'movimientobanco', 'cierrecaja', 'movcaja', 'movcartera', 'movanticipo', 'movprestamo', 'movingreempl', 'movrol', 'comprobantectaxp', 'usuarioapertura', 'anticipoestatus', 'anticipomov', 'anticipousuario', 'cierreventanum', 'cierreventausu', 'aperturaventausu', 'movrecsocio', 'descsociocuotas', 'recsocmovdebito', 'isDeleted'], 'integer'],
            [['valor'], 'number'],
            [['cuenta', 'numeroretencion'], 'string', 'max' => 80],
            [['diario', 'cuentaotros', 'cuentabanco', 'cuentaempleado'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'referencia' => 'Referencia',
            'fecha' => 'Fecha',
            'tipo' => 'Tipo',
            'valor' => 'Valor',
            'proveedor' => 'Proveedor',
            'beneficiario' => 'Beneficiario',
            'tipopago' => 'Tipopago',
            'concepto' => 'Concepto',
            'cuenta' => 'Cuenta',
            'cartera' => 'Cartera',
            'comprobante' => 'Comprobante',
            'disponible' => 'Disponible',
            'diario' => 'Diario',
            'numeroretencion' => 'Numeroretencion',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioan' => 'Usuarioan',
            'fechaan' => 'Fechaan',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'cuentaxpagar' => 'Cuentaxpagar',
            'cuentaotros' => 'Cuentaotros',
            'cuentabanco' => 'Cuentabanco',
            'movimientobanco' => 'Movimientobanco',
            'cierrecaja' => 'Cierrecaja',
            'movcaja' => 'Movcaja',
            'movcartera' => 'Movcartera',
            'movanticipo' => 'Movanticipo',
            'cuentaempleado' => 'Cuentaempleado',
            'movprestamo' => 'Movprestamo',
            'movingreempl' => 'Movingreempl',
            'movrol' => 'Movrol',
            'comprobantectaxp' => 'Comprobantectaxp',
            'usuarioapertura' => 'Usuarioapertura',
            'fechaapertura' => 'Fechaapertura',
            'anticipoestatus' => 'Anticipoestatus',
            'anticipomov' => 'Anticipomov',
            'anticipofecha' => 'Anticipofecha',
            'anticipousuario' => 'Anticipousuario',
            'cierreventanum' => 'Cierreventanum',
            'cierreventafecha' => 'Cierreventafecha',
            'cierreventausu' => 'Cierreventausu',
            'aperturaventafecha' => 'Aperturaventafecha',
            'aperturaventausu' => 'Aperturaventausu',
            'movrecsocio' => 'Movrecsocio',
            'descsociocuotas' => 'Descsociocuotas',
            'recsocmovdebito' => 'Recsocmovdebito',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }

    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }

    public function getProveedor0()
    {
        return $this->hasOne(Proveedores::className(), ['id' => 'proveedor']);
    }

    public function getTipopagocaja0()
    {
        return $this->hasOne(Tipopagocaja::className(), ['id' => 'tipopago']);
    }
}
