<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "retencioncxc".
 *
 * @property int $id
 * @property string $numero
 * @property int|null $item
 * @property int|null $cliente
 * @property string|null $fecha
 * @property int|null $tipoorigen
 * @property int|null $origen
 * @property int|null $rubro
 * @property int|null $tiporetencion
 * @property resource|null $concepto
 * @property float|null $porcentaje
 * @property float|null $valorretenido
 * @property float|null $baseimponible
 * @property int|null $facturanum
 * @property int|null $facturacanal
 * @property int|null $debito
 * @property string|null $cuenta
 * @property int|null $tipodoc
 * @property int|null $declaracionmov
 * @property int|null $usuariodeclara
 * @property string|null $fechadeclara
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int $isDeleted
 * @property string $estatus
 */
class Retencioncxc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'retencioncxc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero'], 'required'],
            [['item', 'cliente', 'tipoorigen', 'origen', 'rubro', 'tiporetencion', 'facturanum', 'facturacanal', 'debito', 'tipodoc', 'declaracionmov', 'usuariodeclara', 'usuariocreacion', 'isDeleted'], 'integer'],
            [['fecha', 'fechadeclara', 'fechacreacion'], 'safe'],
            [['concepto', 'estatus'], 'string'],
            [['porcentaje', 'valorretenido', 'baseimponible'], 'number'],
            [['numero', 'cuenta'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero' => 'Numero',
            'item' => 'Item',
            'cliente' => 'Cliente',
            'fecha' => 'Fecha',
            'tipoorigen' => 'Tipoorigen',
            'origen' => 'Origen',
            'rubro' => 'Rubro',
            'tiporetencion' => 'Tiporetencion',
            'concepto' => 'Concepto',
            'porcentaje' => 'Porcentaje',
            'valorretenido' => 'Valorretenido',
            'baseimponible' => 'Baseimponible',
            'facturanum' => 'Facturanum',
            'facturacanal' => 'Facturacanal',
            'debito' => 'Debito',
            'cuenta' => 'Cuenta',
            'tipodoc' => 'Tipodoc',
            'declaracionmov' => 'Declaracionmov',
            'usuariodeclara' => 'Usuariodeclara',
            'fechadeclara' => 'Fechadeclara',
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

    public function getCliente0()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'cliente']);
    }
}
