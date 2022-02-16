<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proveedores".
 *
 * @property int $id
 * @property resource|null $nombre
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string|null $fechaingreso
 * @property int|null $extranjero
 * @property int|null $natural
 * @property int|null $tipoiden
 * @property string|null $identificacion
 * @property resource|null $contacto
 * @property string|null $fax
 * @property resource|null $correo
 * @property int|null $ciudad
 * @property int|null $pais
 * @property resource|null $notas
 * @property float|null $debito
 * @property float|null $credito
 * @property string|null $ultimopago
 * @property string|null $ultimafactura
 * @property resource|null $cuentacontable
 * @property resource|null $autorizacion
 * @property string|null $validez
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property int|null $usuarioan
 * @property string|null $fechaan
 * @property int|null $comprobanteelec
 * @property resource|null $cuentaanticipo
 * @property resource|null $razoncomercial
 * @property int|null $barrio
 * @property int|null $obligadoconta
 * @property int $provincia
 * @property int $isDeleted
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Proveedores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'contacto', 'correo', 'notas', 'cuentacontable', 'autorizacion', 'cuentaanticipo', 'razoncomercial', 'estatus'], 'string'],
            [['fechaingreso', 'ultimopago', 'ultimafactura', 'validez', 'fechacreacion', 'fechaact', 'fechaan'], 'safe'],
            [['extranjero', 'natural', 'tipoiden', 'ciudad', 'pais', 'usuariocreacion', 'usuarioact', 'usuarioan', 'comprobanteelec', 'barrio', 'obligadoconta', 'provincia', 'isDeleted'], 'integer'],
            [['debito', 'credito'], 'number'],
            [['direccion'], 'string', 'max' => 200],
            [['telefono'], 'string', 'max' => 60],
            [['identificacion'], 'string', 'max' => 13],
            [['fax'], 'string', 'max' => 30],
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
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'fechaingreso' => 'Fechaingreso',
            'extranjero' => 'Extranjero',
            'natural' => 'Natural',
            'tipoiden' => 'Tipoiden',
            'identificacion' => 'Identificacion',
            'contacto' => 'Contacto',
            'fax' => 'Fax',
            'correo' => 'Correo',
            'ciudad' => 'Ciudad',
            'pais' => 'Pais',
            'notas' => 'Notas',
            'debito' => 'Debito',
            'credito' => 'Credito',
            'ultimopago' => 'Ultimopago',
            'ultimafactura' => 'Ultimafactura',
            'cuentacontable' => 'Cuentacontable',
            'autorizacion' => 'Autorizacion',
            'validez' => 'Validez',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'usuarioan' => 'Usuarioan',
            'fechaan' => 'Fechaan',
            'comprobanteelec' => 'Comprobanteelec',
            'cuentaanticipo' => 'Cuentaanticipo',
            'razoncomercial' => 'Razoncomercial',
            'barrio' => 'Barrio',
            'obligadoconta' => 'Obligadoconta',
            'provincia' => 'Provincia',
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
        $response=$this->hasOne(User::className(), ['id' => 'usuarioact']);
        if (!$this->usuarioact){ $response=(object) $array; $response->username="No registra";}
        return $response;
    }
}
