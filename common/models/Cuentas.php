<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cuentas".
 *
 * @property int $id
 * @property string $codigoant
 * @property string $parent
 * @property string $codigo
 * @property resource|null $nombre
 * @property resource|null $descripcion
 * @property string|null $numero
 * @property float $saldo
 * @property string $cheque
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Cuentas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuentas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigoant'], 'required'],
            [['nombre', 'descripcion', 'estatus'], 'string'],
            [['saldo'], 'number'],
            [['usuariocreacion'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['codigoant'], 'string', 'max' => 80],
            [['parent', 'codigo'], 'string', 'max' => 4],
            [['numero'], 'string', 'max' => 25],
            [['cheque'], 'string', 'max' => 15],
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
            'codigoant' => 'Codigoant',
            'parent' => 'Parent',
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'numero' => 'Numero',
            'saldo' => 'Saldo',
            'cheque' => 'Cheque',
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


}
