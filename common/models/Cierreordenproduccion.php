<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cierreordenproduccion".
 *
 * @property int $id
 * @property int $numero
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioan
 * @property string|null $fechaan
 * @property string|null $desde
 * @property string|null $hasta
 * @property int|null $movprodterminado
 * @property int $isDeleted
 * @property string $estatus
 */
class Cierreordenproduccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cierreordenproduccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'usuariocreacion'], 'required'],
            [['numero', 'usuariocreacion', 'usuarioan', 'movprodterminado', 'isDeleted'], 'integer'],
            [['fechacreacion', 'fechaan', 'desde', 'hasta'], 'safe'],
            [['estatus'], 'string'],
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
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioan' => 'Usuarioan',
            'fechaan' => 'Fechaan',
            'desde' => 'Desde',
            'hasta' => 'Hasta',
            'movprodterminado' => 'Movprodterminado',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }
}
