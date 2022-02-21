<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoarticulo".
 *
 * @property int $id
 * @property resource $nombre
 * @property string|null $sufijo
 * @property int $isDeleted
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Tipoarticulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoarticulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nombre', 'fechacreacion'], 'required'],
            [['id', 'isDeleted', 'usuariocreacion'], 'integer'],
            [['nombre'], 'string'],
            [['fechacreacion'], 'safe'],
            [['sufijo', 'estatus'], 'string', 'max' => 10],
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
            'sufijo' => 'Sufijo',
            'isDeleted' => 'Is Deleted',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
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
