<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transporte".
 *
 * @property int $id
 * @property resource $nombre
 * @property resource|null $direccion
 * @property string|null $telefonos
 * @property resource|null $observaciones
 * @property resource|null $contacto
 * @property string|null $ruc
 * @property string|null $placa
 * @property int|null $tipo
 * @property int|null $marca
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int $isDeleted
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Transporte extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transporte';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre', 'direccion', 'observaciones', 'contacto', 'estatus'], 'string'],
            [['tipo', 'marca', 'usuariocreacion', 'isDeleted'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['telefonos'], 'string', 'max' => 40],
            [['ruc'], 'string', 'max' => 13],
            [['placa'], 'string', 'max' => 20],
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
            'direccion' => 'Direccion',
            'telefonos' => 'Telefonos',
            'observaciones' => 'Observaciones',
            'contacto' => 'Contacto',
            'ruc' => 'Ruc',
            'placa' => 'Placa',
            'tipo' => 'Tipo',
            'marca' => 'Marca',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'isDeleted' => 'Is Deleted',
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
