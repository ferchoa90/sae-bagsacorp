<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produccion".
 *
 * @property int $id
 * @property string $articulo
 * @property string $referencia
 * @property string $fecha
 * @property resource $concepto
 * @property string|null $cuenta
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioan
 * @property string|null $fechaan
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property int|null $cierre
 * @property int|null $turno
 * @property int|null $usuariogencosto
 * @property string|null $fechagencosto
 * @property float|null $costoproduccion
 * @property int|null $usuariocierra
 * @property string|null $fechacierra
 * @property float|null $unidadesprod
 * @property float|null $kilosprod
 * @property float|null $materialprep
 * @property float|null $desperdicio
 * @property float|null $diferencia
 * @property int|null $movprodterminado
 * @property float|null $costoprodadicional
 * @property int|null $unidadsec
 * @property float|null $rangodefadicional
 * @property int $isDeleted
 * @property string $estatus
 */
class Produccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['articulo', 'referencia', 'fecha', 'concepto', 'usuariocreacion'], 'required'],
            [['fecha', 'fechacreacion', 'fechaan', 'fechaact', 'fechagencosto', 'fechacierra'], 'safe'],
            [['concepto', 'estatus'], 'string'],
            [['usuariocreacion', 'usuarioan', 'usuarioact', 'cierre', 'turno', 'usuariogencosto', 'usuariocierra', 'movprodterminado', 'unidadsec', 'isDeleted'], 'integer'],
            [['costoproduccion', 'unidadesprod', 'kilosprod', 'materialprep', 'desperdicio', 'diferencia', 'costoprodadicional', 'rangodefadicional'], 'number'],
            [['articulo'], 'string', 'max' => 100],
            [['referencia', 'cuenta'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'articulo' => 'Articulo',
            'referencia' => 'Referencia',
            'fecha' => 'Fecha',
            'concepto' => 'Concepto',
            'cuenta' => 'Cuenta',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioan' => 'Usuarioan',
            'fechaan' => 'Fechaan',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'cierre' => 'Cierre',
            'turno' => 'Turno',
            'usuariogencosto' => 'Usuariogencosto',
            'fechagencosto' => 'Fechagencosto',
            'costoproduccion' => 'Costoproduccion',
            'usuariocierra' => 'Usuariocierra',
            'fechacierra' => 'Fechacierra',
            'unidadesprod' => 'Unidadesprod',
            'kilosprod' => 'Kilosprod',
            'materialprep' => 'Materialprep',
            'desperdicio' => 'Desperdicio',
            'diferencia' => 'Diferencia',
            'movprodterminado' => 'Movprodterminado',
            'costoprodadicional' => 'Costoprodadicional',
            'unidadsec' => 'Unidadsec',
            'rangodefadicional' => 'Rangodefadicional',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }

    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }

    public function getTurno0()
    {
        return $this->hasOne(Turnos::className(), ['id' => 'turno']);
    }

    public function getUsuarioactualizacion0()
    {
        $response=$this->hasOne(User::className(), ['id' => 'usuarioact']);
        if (!$this->usuarioact){ $response=(object) $array; $response->username="No registra";}
        return $response;
    }
}
