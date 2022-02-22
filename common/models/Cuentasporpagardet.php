<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cuentasporpagardet".
 *
 * @property int $id
 * @property int $numero
 * @property int $item
 * @property int $tipofactura
 * @property int $numerofactura
 * @property float $valor
 * @property int|null $cheque
 * @property float $base
 * @property float $porcentaje
 * @property float $valorretenido
 * @property string|null $referencia
 * @property float|null $baseiva
 * @property float|null $poriva1
 * @property float|null $valretenidoiva1
 * @property float|null $poriva2
 * @property float|null $valretenidoiva2
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int $isDeleted
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Cuentasporpagardet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuentasporpagardet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'item', 'tipofactura', 'numerofactura', 'valor', 'base', 'porcentaje', 'valorretenido'], 'required'],
            [['numero', 'item', 'tipofactura', 'numerofactura', 'cheque', 'usuariocreacion', 'isDeleted'], 'integer'],
            [['valor', 'base', 'porcentaje', 'valorretenido', 'baseiva', 'poriva1', 'valretenidoiva1', 'poriva2', 'valretenidoiva2'], 'number'],
            [['fechacreacion'], 'safe'],
            [['estatus'], 'string'],
            [['referencia'], 'string', 'max' => 17],
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
            'cheque' => 'Cheque',
            'base' => 'Base',
            'porcentaje' => 'Porcentaje',
            'valorretenido' => 'Valorretenido',
            'referencia' => 'Referencia',
            'baseiva' => 'Baseiva',
            'poriva1' => 'Poriva1',
            'valretenidoiva1' => 'Valretenidoiva1',
            'poriva2' => 'Poriva2',
            'valretenidoiva2' => 'Valretenidoiva2',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
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
}
