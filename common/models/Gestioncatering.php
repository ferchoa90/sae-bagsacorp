<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gestioncatering".
 *
 * @property int $id
 * @property int $iduser
 * @property int $idhorarioc
 * @property int $idmarcacion
 * @property int $usuariocreacion
 * @property string $fechacreacion
 *
 * @property Horariocomidas $idhorarioc0
 * @property Marcaciones $idmarcacion0
 * @property Empleados $iduser0
 * @property User $usuariocreacion0
 */
class Gestioncatering extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gestioncatering';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iduser', 'idhorarioc', 'idmarcacion'], 'required'],
            [['iduser', 'idhorarioc', 'idmarcacion', 'usuariocreacion'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['idmarcacion'], 'exist', 'skipOnError' => true, 'targetClass' => Marcaciones::className(), 'targetAttribute' => ['idmarcacion' => 'id']],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['idhorarioc'], 'exist', 'skipOnError' => true, 'targetClass' => Horariocomidas::className(), 'targetAttribute' => ['idhorarioc' => 'id']],
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
            'idhorarioc' => 'Idhorarioc',
            'idmarcacion' => 'Idmarcacion',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
        ];
    }

    /**
     * Gets query for [[Idhorarioc0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdhorarioc0()
    {
        return $this->hasOne(Horariocomidas::className(), ['id' => 'idhorarioc']);
    }

    /**
     * Gets query for [[Idmarcacion0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdmarcacion0()
    {
        return $this->hasOne(Marcaciones::className(), ['id' => 'idmarcacion']);
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

    public function getNombreempleado() {

        return $this->iduser0->apellidos . ' '.$this->iduser0->nombres;

}

public function getNombretiposer() {

    return $this->idhorarioc0->nombre ;

}

public function getNombreempresa() {

    return $this->iduser0->iddepartamento0->nombre ;

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
