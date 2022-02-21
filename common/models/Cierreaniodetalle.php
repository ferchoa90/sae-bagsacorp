<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cierreaniodetalle".
 *
 * @property int $id
 * @property int $item
 * @property string $anio
 * @property string $codigo
 * @property float $saldo
 * @property string|null $PADRE
 * @property int|null $INPUTA
 * @property int $isDeleted
 * @property string $estatus
 */
class Cierreaniodetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cierreaniodetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item', 'anio', 'codigo'], 'required'],
            [['item', 'INPUTA', 'isDeleted'], 'integer'],
            [['anio'], 'safe'],
            [['saldo'], 'number'],
            [['estatus'], 'string'],
            [['codigo', 'PADRE'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item' => 'Item',
            'anio' => 'Anio',
            'codigo' => 'Codigo',
            'saldo' => 'Saldo',
            'PADRE' => 'Padre',
            'INPUTA' => 'Inputa',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }

    public function getCuentacontable()
    {
        return $this->hasOne(Cuentas::className(), ['codigoant' => 'codigo']);
    }

}
