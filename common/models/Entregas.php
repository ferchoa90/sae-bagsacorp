<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "entregas".
 *
 * @property int $id
 * @property string|null $nfactura
 * @property string $fecha
 * @property string $hora
 * @property string|null $guiaremision
 * @property int|null $idcliente
 * @property int $bultos
 * @property resource|null $observacion
 * @property string|null $fechaintraslado
 * @property string|null $fechafintraslado
 * @property resource|null $puntopartida
 * @property resource|null $puntollegada
 * @property int|null $transporte
 * @property int|null $proveedor
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Entregas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entregas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'hora', 'usuariocreacion'], 'required'],
            [['fecha', 'hora', 'fechaintraslado', 'fechafintraslado', 'fechacreacion'], 'safe'],
            [['idcliente', 'bultos', 'transporte', 'proveedor', 'isDeleted', 'usuariocreacion'], 'integer'],
            [['observacion', 'puntopartida', 'puntollegada', 'estatus'], 'string'],
            [['nfactura'], 'string', 'max' => 40],
            [['guiaremision'], 'string', 'max' => 80],
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
            'nfactura' => 'Nfactura',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
            'guiaremision' => 'Guiaremision',
            'idcliente' => 'Idcliente',
            'bultos' => 'Bultos',
            'observacion' => 'Observacion',
            'fechaintraslado' => 'Fechaintraslado',
            'fechafintraslado' => 'Fechafintraslado',
            'puntopartida' => 'Puntopartida',
            'puntollegada' => 'Puntollegada',
            'transporte' => 'Transporte',
            'proveedor' => 'Proveedor',
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

    public function getUsuarioactualizacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuarioact']);
    }

    public function getCliente0()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'idcliente']);
    }

    public function getTransporte0()
    {
        return $this->hasOne(Transporte::className(), ['id' => 'transporte']);
    }
}
