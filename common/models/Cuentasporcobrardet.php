<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cuentasporcobrardet".
 *
 * @property int $id
 * @property int $numero
 * @property int $item
 * @property int $tipofactura
 * @property int $numerofactura
 * @property float $valor
 * @property string $fecha
 * @property int|null $cheque
 * @property float $base
 * @property float $porcentaje
 * @property float $valorretenido
 * @property int|null $canal
 * @property float|null $baseiva
 * @property float|null $porcentajeiva1
 * @property float|null $valorretenido1
 * @property float|null $porcentajeiva2
 * @property float|null $valorretenido2
 * @property float|null $porcentajeiva3
 * @property float|null $valorretenido3
 * @property int $isDeleted
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Cuentasporcobrardet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuentasporcobrardet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'item', 'tipofactura', 'numerofactura', 'fecha'], 'required'],
            [['numero', 'item', 'tipofactura', 'numerofactura', 'cheque', 'canal', 'isDeleted', 'usuariocreacion'], 'integer'],
            [['valor', 'base', 'porcentaje', 'valorretenido', 'baseiva', 'porcentajeiva1', 'valorretenido1', 'porcentajeiva2', 'valorretenido2', 'porcentajeiva3', 'valorretenido3'], 'number'],
            [['fecha', 'fechacreacion'], 'safe'],
            [['estatus'], 'string'],
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
            'numero' => 'Numero',
            'item' => 'Item',
            'tipofactura' => 'Tipofactura',
            'numerofactura' => 'Numerofactura',
            'valor' => 'Valor',
            'fecha' => 'Fecha',
            'cheque' => 'Cheque',
            'base' => 'Base',
            'porcentaje' => 'Porcentaje',
            'valorretenido' => 'Valorretenido',
            'canal' => 'Canal',
            'baseiva' => 'Baseiva',
            'porcentajeiva1' => 'Porcentajeiva1',
            'valorretenido1' => 'Valorretenido1',
            'porcentajeiva2' => 'Porcentajeiva2',
            'valorretenido2' => 'Valorretenido2',
            'porcentajeiva3' => 'Porcentajeiva3',
            'valorretenido3' => 'Valorretenido3',
            'isDeleted' => 'Is Deleted',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
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

    public function getfactura0()
    {
        return $this->hasOne(User::className(), ['nfactura' => 'cheque']);
    }

}
