<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoidentificacion".
 *
 * @property int $id
 * @property string $nombre
 * @property string $tipoinformante
 * @property int|null $maximo
 * @property int|null $ats
 * @property string|null $compra
 * @property string|null $venta
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Tipoidentificacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoidentificacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'tipoinformante', 'usuariocreacion'], 'required'],
            [['maximo', 'ats', 'usuariocreacion', 'usuarioact'], 'integer'],
            [['fechacreacion', 'fechaact'], 'safe'],
            [['estatus'], 'string'],
            [['nombre'], 'string', 'max' => 200],
            [['tipoinformante'], 'string', 'max' => 5],
            [['compra', 'venta'], 'string', 'max' => 10],
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
            'tipoinformante' => 'Tipoinformante',
            'maximo' => 'Maximo',
            'ats' => 'Ats',
            'compra' => 'Compra',
            'venta' => 'Venta',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
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
