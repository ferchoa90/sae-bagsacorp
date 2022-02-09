<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banco".
 *
 * @property int $id
 * @property string $referencia
 * @property string $fecha
 * @property int $tipo
 * @property float $valor
 * @property int|null $idproveedor
 * @property resource|null $beneficiario
 * @property int $tipopago
 * @property resource $concepto
 * @property string $cuenta
 * @property int|null $cartera
 * @property int $comprobante
 * @property string|null $disponible
 * @property string|null $diario
 * @property string|null $numeroretencion
 * @property int|null $conciliado
 * @property int|null $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $cuentaporpagar
 * @property string|null $cuentaotros
 * @property string|null $cuentabanco
 * @property int|null $movimientobanco
 * @property int|null $movimientocaja
 * @property int|null $cpcprotreversion
 * @property int|null $cpcprotcargos
 * @property int|null $bcoprotreversion
 * @property int|null $bcoprotcargos
 * @property int|null $bcoprotorigen
 * @property int|null $cpcprotorigen
 * @property int|null $movanticipo
 * @property string|null $cuentaempleado
 * @property int|null $movprestamo
 * @property int|null $movingempleado
 * @property int|null $movrol
 * @property int|null $cpcdeposito
 * @property int|null $cppcomprobante
 * @property int|null $usuariodesconcilia
 * @property string|null $fechadesconcilia
 * @property int|null $estatusanticipo
 * @property int|null $antimovimiento
 * @property string|null $fechaanticipo
 * @property int|null $usuarioanti
 * @property int|null $cierreventan
 * @property string|null $fechacierreventa
 * @property int|null $usuariocierreventa
 * @property int|null $recsociomov
 * @property int|null $recsoccuotas
 * @property int|null $recsocmovdebito
 * @property int|null $cobrosocio
 * @property string $estatus
 */
class Banco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'tipo', 'tipopago', 'concepto', 'cuenta'], 'required'],
            [['fecha', 'disponible', 'fechacreacion', 'fechadesconcilia', 'fechaanticipo', 'fechacierreventa'], 'safe'],
            [['tipo', 'idproveedor', 'tipopago', 'cartera', 'comprobante', 'conciliado', 'usuariocreacion', 'cuentaporpagar', 'movimientobanco', 'movimientocaja', 'cpcprotreversion', 'cpcprotcargos', 'bcoprotreversion', 'bcoprotcargos', 'bcoprotorigen', 'cpcprotorigen', 'movanticipo', 'movprestamo', 'movingempleado', 'movrol', 'cpcdeposito', 'cppcomprobante', 'usuariodesconcilia', 'estatusanticipo', 'antimovimiento', 'usuarioanti', 'cierreventan', 'usuariocierreventa', 'recsociomov', 'recsoccuotas', 'recsocmovdebito', 'cobrosocio'], 'integer'],
            [['valor'], 'number'],
            [['beneficiario', 'concepto', 'estatus'], 'string'],
            [['referencia', 'cuenta', 'diario', 'numeroretencion', 'cuentaotros', 'cuentabanco', 'cuentaempleado'], 'string', 'max' => 50],
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
            'idproveedor' => 'Idproveedor',
            'beneficiario' => 'Beneficiario',
            'tipopago' => 'Tipopago',
            'concepto' => 'Concepto',
            'cuenta' => 'Cuenta',
            'cartera' => 'Cartera',
            'comprobante' => 'Comprobante',
            'disponible' => 'Disponible',
            'diario' => 'Diario',
            'numeroretencion' => 'Numeroretencion',
            'conciliado' => 'Conciliado',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'cuentaporpagar' => 'Cuentaporpagar',
            'cuentaotros' => 'Cuentaotros',
            'cuentabanco' => 'Cuentabanco',
            'movimientobanco' => 'Movimientobanco',
            'movimientocaja' => 'Movimientocaja',
            'cpcprotreversion' => 'Cpcprotreversion',
            'cpcprotcargos' => 'Cpcprotcargos',
            'bcoprotreversion' => 'Bcoprotreversion',
            'bcoprotcargos' => 'Bcoprotcargos',
            'bcoprotorigen' => 'Bcoprotorigen',
            'cpcprotorigen' => 'Cpcprotorigen',
            'movanticipo' => 'Movanticipo',
            'cuentaempleado' => 'Cuentaempleado',
            'movprestamo' => 'Movprestamo',
            'movingempleado' => 'Movingempleado',
            'movrol' => 'Movrol',
            'cpcdeposito' => 'Cpcdeposito',
            'cppcomprobante' => 'Cppcomprobante',
            'usuariodesconcilia' => 'Usuariodesconcilia',
            'fechadesconcilia' => 'Fechadesconcilia',
            'estatusanticipo' => 'Estatusanticipo',
            'antimovimiento' => 'Antimovimiento',
            'fechaanticipo' => 'Fechaanticipo',
            'usuarioanti' => 'Usuarioanti',
            'cierreventan' => 'Cierreventan',
            'fechacierreventa' => 'Fechacierreventa',
            'usuariocierreventa' => 'Usuariocierreventa',
            'recsociomov' => 'Recsociomov',
            'recsoccuotas' => 'Recsoccuotas',
            'recsocmovdebito' => 'Recsocmovdebito',
            'cobrosocio' => 'Cobrosocio',
            'estatus' => 'Estatus',
        ];
    }

    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }

    public function getUsuarioactualizacion0()
    {
        $response=$this->hasOne(User::className(), ['id' => 'usuarioact']);
        if (!$this->usuarioact){ $response=(object) $array; $response->username="No registra";}
        return $response;
    }

    public function getProveedor0()
    {
        return $this->hasOne(Proveedores::className(), ['id' => 'idproveedor']);
    }

    public function getTipopagobanco0()
    {
        return $this->hasOne(Tipopagobanco::className(), ['id' => 'tipopago']);
    }
    
}
