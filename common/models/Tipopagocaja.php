<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipopagocaja".
 *
 * @property int $id
 * @property resource $nombre
 * @property int $mostrar
 * @property string $sufijo
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int $isDeleted
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Tipopagocaja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipopagocaja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'mostrar', 'sufijo', 'usuariocreacion'], 'required'],
            [['nombre', 'estatus'], 'string'],
            [['mostrar', 'usuariocreacion', 'isDeleted'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['sufijo'], 'string', 'max' => 10],
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
            'mostrar' => 'Mostrar',
            'sufijo' => 'Sufijo',
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
