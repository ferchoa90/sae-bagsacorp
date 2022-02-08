<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bodega".
 *
 * @property int $id
 * @property resource $nombre
 * @property int $orden
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property int|null $usuarioan
 * @property string|null $fechaan
 * @property int $isDeleted
 * @property string $estatus
 */
class Bodega extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bodega';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'orden', 'usuariocreacion'], 'required'],
            [['nombre', 'estatus'], 'string'],
            [['orden', 'usuariocreacion', 'usuarioact', 'usuarioan', 'isDeleted'], 'integer'],
            [['fechacreacion', 'fechaact', 'fechaan'], 'safe'],
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
            'orden' => 'Orden',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'usuarioan' => 'Usuarioan',
            'fechaan' => 'Fechaan',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }
}
