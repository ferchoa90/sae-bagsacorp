<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "periodofiscal".
 *
 * @property int $id
 * @property resource $descripcion
 * @property string $anioinicio
 * @property string $aniofin
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Periodofiscal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'periodofiscal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'anioinicio', 'aniofin', 'usuariocreacion'], 'required'],
            [['descripcion', 'estatus'], 'string'],
            [['anioinicio', 'aniofin', 'fechacreacion'], 'safe'],
            [['isDeleted', 'usuariocreacion'], 'integer'],
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
            'descripcion' => 'Descripcion',
            'anioinicio' => 'Anioinicio',
            'aniofin' => 'Aniofin',
            'isDeleted' => 'Is Deleted',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
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
