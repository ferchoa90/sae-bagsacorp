<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cuentasporpagar".
 *
 * @property int $id
 * @property int $idfactura
 * @property int $tipopago
 * @property int $idproveedor
 * @property string $tipo
 * @property string $fecha
 * @property float $valor
 * @property float $abono
 * @property float $saldo
 * @property resource|null $concepto
 * @property resource|null $diario
 * @property resource|null $cuenta
 * @property resource|null $cheque
 * @property string|null $fechacheque
 * @property int $dias
 * @property int $movimientobanco
 * @property float|null $valoriva
 * @property float|null $ivagravado
 * @property float|null $ivapor
 * @property string|null $autorizacion
 * @property int $isDeleted
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Cuentasporpagar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuentasporpagar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfactura', 'tipopago', 'idproveedor', 'tipo', 'fecha', 'usuariocreacion'], 'required'],
            [['idfactura', 'tipopago', 'idproveedor', 'dias', 'movimientobanco', 'isDeleted', 'usuariocreacion'], 'integer'],
            [['tipo', 'concepto', 'diario', 'cuenta', 'cheque', 'estatus'], 'string'],
            [['fecha', 'fechacheque', 'fechacreacion'], 'safe'],
            [['valor', 'abono', 'saldo', 'valoriva', 'ivagravado', 'ivapor'], 'number'],
            [['autorizacion'], 'string', 'max' => 40],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idfactura' => 'Idfactura',
            'tipopago' => 'Tipopago',
            'idproveedor' => 'Idproveedor',
            'tipo' => 'Tipo',
            'fecha' => 'Fecha',
            'valor' => 'Valor',
            'abono' => 'Abono',
            'saldo' => 'Saldo',
            'concepto' => 'Concepto',
            'diario' => 'Diario',
            'cuenta' => 'Cuenta',
            'cheque' => 'Cheque',
            'fechacheque' => 'Fechacheque',
            'dias' => 'Dias',
            'movimientobanco' => 'Movimientobanco',
            'valoriva' => 'Valoriva',
            'ivagravado' => 'Ivagravado',
            'ivapor' => 'Ivapor',
            'autorizacion' => 'Autorizacion',
            'isDeleted' => 'Is Deleted',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Usuariocreacion0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }

    public function getproveedor()
    {
        return $this->hasOne(Proveedores::className(), ['id' => 'idproveedor']);
    }

}
