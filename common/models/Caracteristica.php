<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "caracteristica".
 *
 * @property int $id
 * @property resource $nombre
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property int $isDeleted
 * @property string $estatus
 */
class Caracteristica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'caracteristica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'usuariocreacion'], 'required'],
            [['nombre', 'estatus'], 'string'],
            [['usuariocreacion', 'usuarioact', 'isDeleted'], 'integer'],
            [['fechacreacion', 'fechaact'], 'safe'],
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
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }
}
