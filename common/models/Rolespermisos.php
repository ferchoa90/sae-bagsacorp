<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rolespermisos".
 *
 * @property int $id
 * @property int $idrol
 * @property int $idusuario
 * @property int $idmenu
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property string $fechamod
 * @property string $estatus
 *
 * @property Roles $rol
 * @property User $usuario
 */
class Rolespermisos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rolespermisos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrol', 'idusuario', 'idmenu'], 'required'],
            [['idrol', 'idusuario', 'idmenu', 'isDeleted'], 'integer'],
            [['fechacreacion', 'fechamod'], 'safe'],
            [['estatus'], 'string'],
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
            'idmenu' => 'Idmenu',
            'isDeleted' => 'Is Deleted',
            'fechacreacion' => 'Fechacreacion',
            'fechamod' => 'Fechamod',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Roles::className(), ['id' => 'idrol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'idusuario']);
    }
}
