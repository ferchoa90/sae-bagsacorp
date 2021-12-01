<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "horariocomidas".
 *
 * @property int $id
 * @property string $nombre
 * @property string $horainicio
 * @property string $horafin
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Gestioncatering[] $gestioncaterings
 * @property User $usuariocreacion0
 */
class Horariocomidas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'horariocomidas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'horainicio', 'horafin'], 'required'],
            [['horainicio', 'horafin', 'fechacreacion'], 'safe'],
            [['usuariocreacion'], 'integer'],
            [['estatus'], 'string'],
            [['nombre'], 'string', 'max' => 100],
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
            'horainicio' => 'Horainicio',
            'horafin' => 'Horafin',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Gestioncaterings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGestioncaterings()
    {
        return $this->hasMany(Gestioncatering::className(), ['idhorarioc' => 'id']);
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
