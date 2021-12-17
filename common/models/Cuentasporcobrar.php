<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cuentasporcobrar".
 *
 * @property int $id
 * @property int $idfactura
 * @property int $tipopago
 * @property int $idcliente
 * @property string $tipo
 * @property string $fecha
 * @property float $valor
 * @property float $abono
 * @property float $saldo
 * @property resource|null $concepto
 * @property resource|null $diario
 * @property int $dias
 * @property int $isDeleted
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Cuentasporcobrar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuentasporcobrar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfactura', 'tipopago', 'idcliente', 'tipo', 'fecha', 'usuariocreacion'], 'required'],
            [['idfactura', 'tipopago', 'idcliente', 'dias', 'isDeleted', 'usuariocreacion'], 'integer'],
            [['tipo', 'concepto', 'diario', 'estatus'], 'string'],
            [['fecha', 'fechacreacion'], 'safe'],
            [['valor', 'abono', 'saldo'], 'number'],
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
            'idcliente' => 'Idcliente',
            'tipo' => 'Tipo',
            'fecha' => 'Fecha',
            'valor' => 'Valor',
            'abono' => 'Abono',
            'saldo' => 'Saldo',
            'concepto' => 'Concepto',
            'diario' => 'Diario',
            'dias' => 'Dias',
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
}
