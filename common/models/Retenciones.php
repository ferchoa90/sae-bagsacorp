<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "retenciones".
 *
 * @property int $id
 * @property int|null $origencomprobante
 * @property int $numero
 * @property int|null $item
 * @property string|null $serie
 * @property string|null $fecha
 * @property int|null $tipo
 * @property int|null $origen
 * @property int|null $proveedor
 * @property int|null $rubro
 * @property int|null $tiporetencion
 * @property resource|null $concepto
 * @property float|null $porcentaje
 * @property float|null $valoretenido
 * @property float|null $baseimponible
 * @property string|null $comprobante
 * @property int|null $tipocomprobante
 * @property string|null $identificacion
 * @property int|null $tipoidentificacion
 * @property resource|null $direccion
 * @property int|null $ciudad
 * @property resource|null $beneficiario
 * @property string|null $autorizacion
 * @property string|null $validez
 * @property string|null $retencionaut
 * @property int|null $tipodocumento
 * @property int|null $usuariodeclara
 * @property string|null $fechadeclara
 * @property int|null $declaracionmov
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int $isDeleted
 * @property string $estatus
 */
class Retenciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'retenciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['origencomprobante', 'numero', 'item', 'tipo', 'origen', 'proveedor', 'rubro', 'tiporetencion', 'tipocomprobante', 'tipoidentificacion', 'ciudad', 'tipodocumento', 'usuariodeclara', 'declaracionmov', 'usuariocreacion', 'isDeleted'], 'integer'],
            [['numero', 'isDeleted'], 'required'],
            [['fecha', 'validez', 'fechadeclara', 'fechacreacion'], 'safe'],
            [['concepto', 'direccion', 'beneficiario', 'estatus'], 'string'],
            [['porcentaje', 'valoretenido', 'baseimponible'], 'number'],
            [['serie'], 'string', 'max' => 40],
            [['comprobante', 'autorizacion', 'retencionaut'], 'string', 'max' => 80],
            [['identificacion'], 'string', 'max' => 13],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'origencomprobante' => 'Origencomprobante',
            'numero' => 'Numero',
            'item' => 'Item',
            'serie' => 'Serie',
            'fecha' => 'Fecha',
            'tipo' => 'Tipo',
            'origen' => 'Origen',
            'proveedor' => 'Proveedor',
            'rubro' => 'Rubro',
            'tiporetencion' => 'Tiporetencion',
            'concepto' => 'Concepto',
            'porcentaje' => 'Porcentaje',
            'valoretenido' => 'Valoretenido',
            'baseimponible' => 'Baseimponible',
            'comprobante' => 'Comprobante',
            'tipocomprobante' => 'Tipocomprobante',
            'identificacion' => 'Identificacion',
            'tipoidentificacion' => 'Tipoidentificacion',
            'direccion' => 'Direccion',
            'ciudad' => 'Ciudad',
            'beneficiario' => 'Beneficiario',
            'autorizacion' => 'Autorizacion',
            'validez' => 'Validez',
            'retencionaut' => 'Retencionaut',
            'tipodocumento' => 'Tipodocumento',
            'usuariodeclara' => 'Usuariodeclara',
            'fechadeclara' => 'Fechadeclara',
            'declaracionmov' => 'Declaracionmov',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }

    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }

    public function getRubroretencion()
    {
        return $this->hasOne(Rubroretencion::className(), ['codigo' => 'rubro']);
    }

    public function getProveedor0()
    {
        return $this->hasOne(Proveedores::className(), ['id' => 'proveedor']);
    }

  
}
