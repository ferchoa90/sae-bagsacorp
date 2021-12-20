<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cuentasparametros".
 *
 * @property int $id
 * @property resource $nombre
 * @property resource|null $descripcion
 * @property int $idcuentacontable
 * @property string $cuentacontable
 * @property string|null $cuentaanticipo
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string $estatus
 *
 * @property Cuentas $idcuentacontable0
 * @property User $usuariocreacion0
 */
class Cuentasparametros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuentasparametros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'idcuentacontable', 'cuentacontable'], 'required'],
            [['nombre', 'descripcion', 'estatus'], 'string'],
            [['idcuentacontable', 'isDeleted', 'usuariocreacion'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['cuentacontable', 'cuentaanticipo'], 'string', 'max' => 80],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['idcuentacontable'], 'exist', 'skipOnError' => true, 'targetClass' => Cuentas::className(), 'targetAttribute' => ['idcuentacontable' => 'id']],
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
            'descripcion' => 'Descripcion',
            'idcuentacontable' => 'Idcuentacontable',
            'cuentacontable' => 'Cuentacontable',
            'cuentaanticipo' => 'Cuentaanticipo',
            'isDeleted' => 'Is Deleted',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Idcuentacontable0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcuentacontable0()
    {
        return $this->hasOne(Cuentas::className(), ['id' => 'idcuentacontable']);
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
