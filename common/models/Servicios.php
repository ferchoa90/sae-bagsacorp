<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicios".
 *
 * @property int $id
 * @property string $nombre
 * @property resource $descripcion
 * @property int $idsucursal
 * @property string $precio
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Sucursal $sucursal
 * @property User $usuariocreacion0
 */
class Servicios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'servicios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'idsucursal'], 'required'],
            [['descripcion', 'estatus'], 'string'],
            [['idsucursal', 'usuariocreacion'], 'integer'],
            [['precio'], 'number'],
            [['fechacreacion'], 'safe'],
            [['nombre'], 'string', 'max' => 150],
            [['idsucursal'], 'exist', 'skipOnError' => true, 'targetClass' => Sucursal::className(), 'targetAttribute' => ['idsucursal' => 'id']],
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
            'descripcion' => 'Descripcion',
            'idsucursal' => 'Idsucursal',
            'precio' => 'Precio',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSucursal()
    {
        return $this->hasOne(Sucursal::className(), ['id' => 'idsucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }
}
