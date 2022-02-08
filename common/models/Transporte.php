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
 * @property int $isDeleted
 * @property string $estatus
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
            [['tipo', 'marca', 'isDeleted'], 'integer'],
            [['telefonos'], 'string', 'max' => 40],
            [['ruc'], 'string', 'max' => 13],
            [['placa'], 'string', 'max' => 20],
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
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }
}
