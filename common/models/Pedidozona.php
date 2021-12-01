<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pedidozona".
 *
 * @property int $id
 * @property resource $descripcion
 * @property resource $observacion
 * @property float $subtotal
 * @property float $iva
 * @property float $total
 * @property float $pedidominimo
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Pedidos[] $pedidos
 */
class Pedidozona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidozona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'observacion', 'subtotal', 'total', 'usuariocreacion', 'estatus'], 'required'],
            [['descripcion', 'observacion', 'estatus'], 'string'],
            [['subtotal', 'iva', 'total', 'pedidominimo'], 'number'],
            [['usuariocreacion'], 'integer'],
            [['fechacreacion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'observacion' => 'Observacion',
            'subtotal' => 'Subtotal',
            'iva' => 'Iva',
            'total' => 'Total',
            'pedidominimo' => 'Pedidominimo',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['idzona' => 'id']);
    }
}
