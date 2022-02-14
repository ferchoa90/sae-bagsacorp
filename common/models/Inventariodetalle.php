<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "inventariodetalle".
 *
 * @property int $id
 * @property int $numero
 * @property int|null $item
 * @property int|null $tipomovimiento
 * @property string|null $fecha
 * @property string|null $articulo
 * @property float|null $cantidad
 * @property float|null $valorunitario
 * @property float|null $costo
 * @property float|null $descuento
 * @property float|null $ivalinea
 * @property int|null $bodegaorigen
 * @property int|null $bodegadestino
 * @property int|null $liquidacion
 * @property float|null $valorparcial
 * @property float|null $valoriva
 * @property float|null $valordescuento
 * @property string|null $hora
 * @property int|null $cantidadad
 * @property int|null $unidadad
 * @property float|null $valorunitad
 * @property float|null $valorparcialad
 * @property float|null $costounitarioad
 * @property float|null $valordescad
 * @property float|null $ivavaladic
 * @property float|null $rangodesdead
 * @property float|null $rangohastaad
 * @property float|null $rangodefadic
 * @property float|null $rangoivagrabado
 * @property float|null $rangosubivacero
 * @property int $isDeleted
 * @property string $estatus
 */
class Inventariodetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventariodetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero'], 'required'],
            [['numero', 'item', 'tipomovimiento', 'bodegaorigen', 'bodegadestino', 'liquidacion', 'cantidadad', 'unidadad', 'isDeleted'], 'integer'],
            [['fecha', 'hora'], 'safe'],
            [['cantidad', 'valorunitario', 'costo', 'descuento', 'ivalinea', 'valorparcial', 'valoriva', 'valordescuento', 'valorunitad', 'valorparcialad', 'costounitarioad', 'valordescad', 'ivavaladic', 'rangodesdead', 'rangohastaad', 'rangodefadic', 'rangoivagrabado', 'rangosubivacero'], 'number'],
            [['estatus'], 'string'],
            [['articulo'], 'string', 'max' => 50],
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
            'tipomovimiento' => 'Tipomovimiento',
            'fecha' => 'Fecha',
            'articulo' => 'Articulo',
            'cantidad' => 'Cantidad',
            'valorunitario' => 'Valorunitario',
            'costo' => 'Costo',
            'descuento' => 'Descuento',
            'ivalinea' => 'Ivalinea',
            'bodegaorigen' => 'Bodegaorigen',
            'bodegadestino' => 'Bodegadestino',
            'liquidacion' => 'Liquidacion',
            'valorparcial' => 'Valorparcial',
            'valoriva' => 'Valoriva',
            'valordescuento' => 'Valordescuento',
            'hora' => 'Hora',
            'cantidadad' => 'Cantidadad',
            'unidadad' => 'Unidadad',
            'valorunitad' => 'Valorunitad',
            'valorparcialad' => 'Valorparcialad',
            'costounitarioad' => 'Costounitarioad',
            'valordescad' => 'Valordescad',
            'ivavaladic' => 'Ivavaladic',
            'rangodesdead' => 'Rangodesdead',
            'rangohastaad' => 'Rangohastaad',
            'rangodefadic' => 'Rangodefadic',
            'rangoivagrabado' => 'Rangoivagrabado',
            'rangosubivacero' => 'Rangosubivacero',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }
}
