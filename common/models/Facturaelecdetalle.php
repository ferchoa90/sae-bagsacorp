<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "facturaelecdetalle".
 *
 * @property int $id
 * @property int $idfactura
 * @property int|null $tipomov
 * @property int $item
 * @property int|null $canal
 * @property string|null $fecha
 * @property string $narticulo
 * @property float $cantidad
 * @property float $valoru
 * @property float|null $costo
 * @property float|null $descuento
 * @property float $iva
 * @property int $bodegaorigen
 * @property int|null $bodegadestino
 * @property float|null $liquidacion
 * @property float|null $valorparcial
 * @property float $civa
 * @property float|null $valordes
 * @property string|null $hora
 * @property resource|null $observaciones
 * @property int|null $coeficiente
 * @property float|null $cantidadadic
 * @property float|null $unidadadic
 * @property float|null $valorunadic
 * @property float|null $rangodesde
 * @property float|null $rangohasta
 * @property int|null $unibultoadic
 * @property string $imagen
 * @property string $fechacreacion
 * @property string $estatus
 */
class Facturaelecdetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facturaelecdetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfactura', 'item', 'narticulo', 'cantidad', 'valoru', 'iva'], 'required'],
            [['idfactura', 'tipomov', 'item', 'canal', 'bodegaorigen', 'bodegadestino', 'coeficiente', 'unibultoadic'], 'integer'],
            [['fecha', 'hora', 'fechacreacion'], 'safe'],
            [['cantidad', 'valoru', 'costo', 'descuento', 'iva', 'liquidacion', 'valorparcial', 'civa', 'valordes', 'cantidadadic', 'unidadadic', 'valorunadic', 'rangodesde', 'rangohasta'], 'number'],
            [['observaciones', 'estatus'], 'string'],
            [['narticulo', 'imagen'], 'string', 'max' => 350],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idfactura' => 'Idfactura',
            'tipomov' => 'Tipomov',
            'item' => 'Item',
            'canal' => 'Canal',
            'fecha' => 'Fecha',
            'narticulo' => 'Narticulo',
            'cantidad' => 'Cantidad',
            'valoru' => 'Valoru',
            'costo' => 'Costo',
            'descuento' => 'Descuento',
            'iva' => 'Iva',
            'bodegaorigen' => 'Bodegaorigen',
            'bodegadestino' => 'Bodegadestino',
            'liquidacion' => 'Liquidacion',
            'valorparcial' => 'Valorparcial',
            'civa' => 'Civa',
            'valordes' => 'Valordes',
            'hora' => 'Hora',
            'observaciones' => 'Observaciones',
            'coeficiente' => 'Coeficiente',
            'cantidadadic' => 'Cantidadadic',
            'unidadadic' => 'Unidadadic',
            'valorunadic' => 'Valorunadic',
            'rangodesde' => 'Rangodesde',
            'rangohasta' => 'Rangohasta',
            'unibultoadic' => 'Unibultoadic',
            'imagen' => 'Imagen',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }
}
