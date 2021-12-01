<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pedidos".
 *
 * @property int $id
 * @property int $idcliente
 * @property resource $nombres
 * @property resource $direccion
 * @property resource $telefono
 * @property int $idzona
 * @property float $subtotal
 * @property float $iva
 * @property float $total
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatuspedido
 * @property string $estatus
 *
 * @property User $idcliente0
 * @property Pedidozona $idzona0
 * @property Pedidodetalle[] $pedidodetalles
 * @property Pedidosdetalle[] $pedidosdetalles
 * @property User $usuariocreacion0
 */
class Pedidos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcliente', 'nombres', 'direccion', 'telefono', 'subtotal', 'total', 'usuariocreacion'], 'required'],
            [['idcliente', 'idzona', 'usuariocreacion'], 'integer'],
            [['nombres', 'direccion', 'telefono', 'estatuspedido', 'estatus'], 'string'],
            [['subtotal', 'iva', 'total'], 'number'],
            [['fechacreacion'], 'safe'],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idcliente' => 'id']],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['idzona'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidozona::className(), 'targetAttribute' => ['idzona' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idcliente' => 'Idcliente',
            'nombres' => 'Nombres',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'idzona' => 'Idzona',
            'subtotal' => 'Subtotal',
            'iva' => 'Iva',
            'total' => 'Total',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatuspedido' => 'Estatuspedido',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Idcliente0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcliente0()
    {
        return $this->hasOne(User::className(), ['id' => 'idcliente']);
    }

    /**
     * Gets query for [[Idzona0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdzona0()
    {
        return $this->hasOne(Pedidozona::className(), ['id' => 'idzona']);
    }

    /**
     * Gets query for [[Pedidodetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidodetalles()
    {
        return $this->hasMany(Pedidodetalle::className(), ['idpedido' => 'id']);
    }

    /**
     * Gets query for [[Pedidosdetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidosdetalles()
    {
        return $this->hasMany(Pedidosdetalle::className(), ['idpedido' => 'id']);
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
