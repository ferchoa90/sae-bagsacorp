<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vendedores".
 *
 * @property int $id
 * @property resource $nombre
 * @property string $ingreso
 * @property resource|null $direccion
 * @property string|null $telefono
 * @property string|null $correo
 * @property int|null $ultimacomision
 * @property string|null $desde
 * @property string|null $hasta
 * @property string|null $ultimoproceso
 * @property resource|null $notas
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property int|null $usuarioan
 * @property string|null $fechaan
 * @property int|null $proforma
 * @property string|null $fechanac
 * @property int|null $tipoidentificacion
 * @property string|null $identificacion
 * @property float|null $comision
 * @property int $isDeleted
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Vendedores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendedores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'ingreso', 'usuariocreacion'], 'required'],
            [['nombre', 'direccion', 'notas', 'estatus'], 'string'],
            [['ingreso', 'desde', 'hasta', 'ultimoproceso', 'fechacreacion', 'fechaact', 'fechaan', 'fechanac'], 'safe'],
            [['ultimacomision', 'usuariocreacion', 'usuarioact', 'usuarioan', 'proforma', 'tipoidentificacion', 'isDeleted'], 'integer'],
            [['comision'], 'number'],
            [['telefono'], 'string', 'max' => 30],
            [['correo'], 'string', 'max' => 100],
            [['identificacion'], 'string', 'max' => 13],
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
            'ingreso' => 'Ingreso',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'correo' => 'Correo',
            'ultimacomision' => 'Ultimacomision',
            'desde' => 'Desde',
            'hasta' => 'Hasta',
            'ultimoproceso' => 'Ultimoproceso',
            'notas' => 'Notas',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'usuarioan' => 'Usuarioan',
            'fechaan' => 'Fechaan',
            'proforma' => 'Proforma',
            'fechanac' => 'Fechanac',
            'tipoidentificacion' => 'Tipoidentificacion',
            'identificacion' => 'Identificacion',
            'comision' => 'Comision',
            'isDeleted' => 'Is Deleted',
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

    public function getUsuarioactualizacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuarioact']);
    }

}
