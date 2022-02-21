<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cierreanio".
 *
 * @property int $id
 * @property int $idperiodo
 * @property resource|null $detalles
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Periodofiscal $idperiodo0
 * @property User $usuariocreacion0
 */
class Cierreanio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cierreanio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idperiodo', 'usuariocreacion'], 'integer'],
            [['detalles', 'estatus'], 'string'],
            [['usuariocreacion'], 'required'],
            [['fechacreacion'], 'safe'],
            [['idperiodo'], 'exist', 'skipOnError' => true, 'targetClass' => Periodofiscal::className(), 'targetAttribute' => ['idperiodo' => 'id']],
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
            'idperiodo' => 'Idperiodo',
            'detalles' => 'Detalles',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Idperiodo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdperiodo0()
    {
        return $this->hasOne(Periodofiscal::className(), ['id' => 'idperiodo']);
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
