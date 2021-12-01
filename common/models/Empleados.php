<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "empleados".
 *
 * @property int $id
 * @property string|null $cedula
 * @property string $apellidos
 * @property string $nombres
 * @property string|null $fechaingreso
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string|null $tiposangre
 * @property string|null $nacionalidad
 * @property string|null $contactoemer
 * @property string|null $telefonoemer
 * @property int $iddepartamento
 * @property string|null $fechasalida
 * @property int $isDeleted
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Departamentos $iddepartamento0
 * @property User $usuariocreacion0
 */
class Empleados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empleados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apellidos', 'nombres'], 'required'],
            [['fechaingreso', 'fechasalida', 'fechacreacion'], 'safe'],
            [['direccion', 'estatus'], 'string'],
            [['iddepartamento', 'isDeleted', 'usuariocreacion'], 'integer'],
            [['cedula'], 'string', 'max' => 15],
            [['apellidos', 'nombres'], 'string', 'max' => 100],
            [['telefono', 'telefonoemer'], 'string', 'max' => 20],
            [['tiposangre'], 'string', 'max' => 4],
            [['nacionalidad'], 'string', 'max' => 50],
            [['contactoemer'], 'string', 'max' => 150],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['iddepartamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['iddepartamento' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cedula' => 'Cedula',
            'apellidos' => 'Apellidos',
            'nombres' => 'Nombres',
            'fechaingreso' => 'Fechaingreso',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'tiposangre' => 'Tiposangre',
            'nacionalidad' => 'Nacionalidad',
            'contactoemer' => 'Contactoemer',
            'telefonoemer' => 'Telefonoemer',
            'iddepartamento' => 'Iddepartamento',
            'fechasalida' => 'Fechasalida',
            'isDeleted' => 'Is Deleted',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Iddepartamento0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIddepartamento0()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'iddepartamento']);
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
