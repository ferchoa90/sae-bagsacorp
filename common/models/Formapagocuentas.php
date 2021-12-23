<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "formapagocuentas".
 *
 * @property int $id
 * @property resource $nombre
 * @property string $cuentapc
 * @property string $cuentapp
 * @property string $sufijo
 * @property int $formapagoats
 * @property int $anticipocpp
 * @property int $anticipocpc
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Formapagocuentas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'formapagocuentas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre', 'estatus'], 'string'],
            [['formapagoats', 'anticipocpp', 'anticipocpc', 'isDeleted', 'usuariocreacion'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['cuentapc', 'cuentapp'], 'string', 'max' => 50],
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
            'cuentapc' => 'Cuentapc',
            'cuentapp' => 'Cuentapp',
            'sufijo' => 'Sufijo',
            'formapagoats' => 'Formapagoats',
            'anticipocpp' => 'Anticipocpp',
            'anticipocpc' => 'Anticipocpc',
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
