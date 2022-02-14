<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "motivoanulacion".
 *
 * @property int $id
 * @property resource $nombre
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property int|null $usuarioan
 * @property string|null $fechaan
 * @property int $isDeleted
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Motivoanulacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'motivoanulacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'usuariocreacion'], 'required'],
            [['nombre', 'estatus'], 'string'],
            [['usuariocreacion', 'usuarioact', 'usuarioan', 'isDeleted'], 'integer'],
            [['fechacreacion', 'fechaact', 'fechaan'], 'safe'],
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
