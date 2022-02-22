<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "diario".
 *
 * @property int $id
 * @property int $diario
 * @property string $anio
 * @property string $fecha
 * @property int $tipo
 * @property resource $concepto
 * @property float $total
 * @property int $auxiliar
 * @property string $tipoaux
 * @property int|null $iddepartamento
 * @property int $isDeleted
 * @property int|null $anticipoctaxp
 * @property int|null $anticipoctaxc
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Diario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['diario', 'anio', 'fecha', 'tipo', 'concepto', 'auxiliar', 'tipoaux'], 'required'],
            [['diario', 'tipo', 'auxiliar', 'iddepartamento', 'isDeleted', 'anticipoctaxp', 'anticipoctaxc', 'usuariocreacion'], 'integer'],
            [['anio', 'fecha', 'fechacreacion'], 'safe'],
            [['concepto', 'estatus'], 'string'],
            [['total'], 'number'],
            [['tipoaux'], 'string', 'max' => 10],
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
            'fecha' => 'Fecha',
            'tipo' => 'Tipo',
            'concepto' => 'Concepto',
            'total' => 'Total',
            'auxiliar' => 'Auxiliar',
            'tipoaux' => 'Tipoaux',
            'iddepartamento' => 'Iddepartamento',
            'isDeleted' => 'Is Deleted',
            'anticipoctaxp' => 'Anticipoctaxp',
            'anticipoctaxc' => 'Anticipoctaxc',
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

    public function getTipodiario()
    {
        return $this->hasOne(Tipodiario::className(), ['id' => 'tipo']);
    }

    

    public function getUsuarioactualizacion0()
    {
        $response=$this->hasOne(User::className(), ['id' => 'usuarioact']);
        if (!$this->usuarioact){ $response=(object) $array; $response->username="No registra";}
        return $response;
    }


}
