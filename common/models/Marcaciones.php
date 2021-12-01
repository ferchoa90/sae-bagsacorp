<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marcaciones".
 *
 * @property int $id
 * @property int $iduser
 * @property string $fechahora
 * @property int $sucursal
 * @property string $fechacreacion
 * @property int $usuariocreacion
 *
 * @property Gestioncatering[] $gestioncaterings
 * @property Empleados $iduser0
 * @property User $usuariocreacion0
 */
class Marcaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marcaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iduser', 'fechahora'], 'required'],
            [['iduser', 'sucursal', 'usuariocreacion'], 'integer'],
            [['fechahora', 'fechacreacion'], 'safe'],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['iduser'], 'exist', 'skipOnError' => true, 'targetClass' => Empleados::className(), 'targetAttribute' => ['iduser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iduser' => 'Iduser',
            'fechahora' => 'Fechahora',
            'sucursal' => 'Sucursal',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
        ];
    }

    /**
     * Gets query for [[Gestioncaterings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGestioncaterings()
    {
        return $this->hasMany(Gestioncatering::className(), ['idmarcacion' => 'id']);
    }

    /**
     * Gets query for [[Iduser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIduser0()
    {
        return $this->hasOne(Empleados::className(), ['id' => 'iduser']);
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
