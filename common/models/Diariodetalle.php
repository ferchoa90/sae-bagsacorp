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
 * @property resource|null $concepto
 * @property string|null $cuenta
 * @property string|null $cuenta_padre
 * @property float $valor
 * @property int $debito
 * @property int|null $tipodiario
 * @property int|null $auxiliar
 * @property string $tipoauxiliar
 * @property int $isDeleted
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
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
            [['diario', 'anio', 'item', 'fecha', 'tipoauxiliar'], 'required'],
            [['diario', 'item', 'debito', 'tipodiario', 'auxiliar', 'isDeleted', 'usuariocreacion'], 'integer'],
            [['anio', 'fecha', 'fechacreacion'], 'safe'],
            [['concepto', 'estatus'], 'string'],
            [['valor'], 'number'],
            [['cuenta', 'cuenta_padre'], 'string', 'max' => 80],
            [['tipoauxiliar'], 'string', 'max' => 10],
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

    /*public function getCuentacontable()
    {
        echo ':'.($this->cuenta).' - ';
        $result= Cuentas::find()->where(["codigoant"=>"2.1.03.001.001.002030"])->one();
        var_dump($result);
        //var_dump($this->hasOne(Cuentas::className(), ['codigoant' => 'cuenta']));
        return $result;
    }*/

    public function getCuentacontable0()
    {
        //echo $this->cuenta;
        return $this->hasOne(Cuentas::className(), ['codigoant' => 'cuenta']);
    }
}
