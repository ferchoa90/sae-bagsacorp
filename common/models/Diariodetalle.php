<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "diariodetalle".
 *
 * @property int $id
 * @property int $diario
 * @property string $anio
 * @property int $item
 * @property string $fecha
 * @property resource $concepto
 * @property string $cuenta
 * @property string $cuenta_padre
 * @property float $valor
 * @property int $debito
 * @property int $tipodiario
 * @property int $auxiliar
 * @property string $tipoauxiliar
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property string $estatus
 */
class Diariodetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diariodetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['diario', 'anio', 'item', 'fecha', 'concepto', 'cuenta', 'cuenta_padre', 'valor', 'tipodiario', 'auxiliar', 'tipoauxiliar'], 'required'],
            [['diario', 'item', 'debito', 'tipodiario', 'auxiliar', 'isDeleted'], 'integer'],
            [['anio', 'fecha', 'fechacreacion'], 'safe'],
            [['concepto', 'estatus'], 'string'],
            [['valor'], 'number'],
            [['cuenta', 'cuenta_padre'], 'string', 'max' => 80],
            [['tipoauxiliar'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'diario' => 'Diario',
            'anio' => 'Anio',
            'item' => 'Item',
            'fecha' => 'Fecha',
            'concepto' => 'Concepto',
            'cuenta' => 'Cuenta',
            'cuenta_padre' => 'Cuenta Padre',
            'valor' => 'Valor',
            'debito' => 'Debito',
            'tipodiario' => 'Tipodiario',
            'auxiliar' => 'Auxiliar',
            'tipoauxiliar' => 'Tipoauxiliar',
            'isDeleted' => 'Is Deleted',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }
}
