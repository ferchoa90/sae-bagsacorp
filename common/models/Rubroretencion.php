<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rubroretencion".
 *
 * @property int $id
 * @property string $codigo
 * @property resource $concepto
 * @property float|null $porsociedad
 * @property string|null $ctasociedad
 * @property float|null $pornatural
 * @property string|null $ctanatural
 * @property int $tipo
 * @property string|null $cuentasociedadcxc
 * @property string|null $cuentanaturalcxc
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int $isDeleted
 * @property string $estatus
 */
class Rubroretencion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rubroretencion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'concepto', 'tipo'], 'required'],
            [['concepto', 'estatus'], 'string'],
            [['porsociedad', 'pornatural'], 'number'],
            [['tipo', 'usuariocreacion', 'isDeleted'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['codigo'], 'string', 'max' => 30],
            [['ctasociedad', 'ctanatural', 'cuentasociedadcxc', 'cuentanaturalcxc'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'concepto' => 'Concepto',
            'porsociedad' => 'Porsociedad',
            'ctasociedad' => 'Ctasociedad',
            'pornatural' => 'Pornatural',
            'ctanatural' => 'Ctanatural',
            'tipo' => 'Tipo',
            'cuentasociedadcxc' => 'Cuentasociedadcxc',
            'cuentanaturalcxc' => 'Cuentanaturalcxc',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }
}
