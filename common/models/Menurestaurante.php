<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menurestaurante".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string $fechacombo
 * @property int $producto1
 * @property int $producto2
 * @property int|null $producto3
 * @property int|null $producto4
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Productos $producto10
 * @property Productos $producto20
 * @property Productos $producto30
 * @property Productos $producto40
 * @property User $usuariocreacion0
 */
class Menurestaurante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menurestaurante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'estatus'], 'string'],
            [['fechacombo', 'producto1', 'producto2', 'usuariocreacion'], 'required'],
            [['fechacombo', 'fechacreacion'], 'safe'],
            [['producto1', 'producto2', 'producto3', 'producto4', 'usuariocreacion'], 'integer'],
            [['producto1'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['producto1' => 'id']],
            [['producto2'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['producto2' => 'id']],
            [['producto3'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['producto3' => 'id']],
            [['producto4'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['producto4' => 'id']],
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
            'nombre' => 'Nombre',
            'fechacombo' => 'Fechacombo',
            'producto1' => 'Producto1',
            'producto2' => 'Producto2',
            'producto3' => 'Producto3',
            'producto4' => 'Producto4',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Producto10]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto10()
    {
        return $this->hasOne(Productos::className(), ['id' => 'producto1']);
    }

    /**
     * Gets query for [[Producto20]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto20()
    {
        return $this->hasOne(Productos::className(), ['id' => 'producto2']);
    }

    /**
     * Gets query for [[Producto30]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto30()
    {
        return $this->hasOne(Productos::className(), ['id' => 'producto3']);
    }

    /**
     * Gets query for [[Producto40]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto40()
    {
        return $this->hasOne(Productos::className(), ['id' => 'producto4']);
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
