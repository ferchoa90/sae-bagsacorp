<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usuariorol".
 *
 * @property int $id
 * @property int $idrol
 * @property int $idusuario
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string $estatus
 *
 * @property Roles $idrol0
 * @property User $idusuario0
 * @property User $usuariocreacion0
 */
class Usuariorol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuariorol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrol', 'idusuario'], 'required'],
            [['idrol', 'idusuario', 'usuariocreacion'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['estatus'], 'string'],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['idrol'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['idrol' => 'id']],
            [['idusuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idusuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrol' => 'Idrol',
            'idusuario' => 'Idusuario',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Idrol0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdrol0()
    {
        return $this->hasOne(Roles::className(), ['id' => 'idrol']);
    }

    /**
     * Gets query for [[Idusuario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdusuario0()
    {
        return $this->hasOne(User::className(), ['id' => 'idusuario']);
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
