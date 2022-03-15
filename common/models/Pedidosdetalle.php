<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pedidosdetalle".
 *
 * @property int $id
 * @property int $idpedido
 * @property int $idproducto
 * @property resource|null $combo
 * @property resource $nombreprod
 * @property resource|null $descripcion
 * @property resource|null $observacion
 * @property int $cantidad
 * @property float $subtotal
 * @property float $descuento
 * @property float $iva
 * @property float $total
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Pedidos $idpedido0
 * @property Productos $idproducto0
 * @property User $usuariocreacion0
 */
class Pedidosdetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidosdetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpedido', 'idproducto', 'nombreprod', 'subtotal', 'usuariocreacion'], 'required'],
            [['idpedido', 'idproducto', 'usuariocreacion'], 'integer'],
            [['combo', 'nombreprod', 'descripcion', 'observacion', 'estatus'], 'string'],
            [['subtotal', 'descuento', 'iva', 'total', 'cantidad'], 'number'],
            [['fechacreacion'], 'safe'],
            [['idpedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['idpedido' => 'id']],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['idproducto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idpedido' => 'Idpedido',
            'idproducto' => 'Idproducto',
            'combo' => 'Combo',
            'nombreprod' => 'Nombreprod',
            'descripcion' => 'Descripcion',
            'observacion' => 'Observacion',
            'cantidad' => 'Cantidad',
            'subtotal' => 'Subtotal',
            'descuento' => 'Descuento',
            'iva' => 'Iva',
            'total' => 'Total',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Idpedido0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdpedido0()
    {
        return $this->hasOne(Pedidos::className(), ['id' => 'idpedido']);
    }

    /**
     * Gets query for [[Idproducto0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdproducto0()
    {
        return $this->hasOne(Productos::className(), ['id' => 'idproducto']);
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
