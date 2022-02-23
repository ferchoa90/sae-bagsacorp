<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cuentasporcobrar".
 *
 * @property int $id
 * @property string $tipo
 * @property int $idcliente
 * @property int $idfactura
 * @property int $tipopago
 * @property string $fecha
 * @property float $valor
 * @property float $abono
 * @property float $saldo
 * @property resource|null $concepto
 * @property int|null $formapago
 * @property int|null $banco
 * @property int|null $cheque
 * @property string|null $fechacheque
 * @property int|null $tipocheque
 * @property int|null $deposito
 * @property int|null $movimientobanco
 * @property string|null $cuenta
 * @property string|null $vencimiento
 * @property resource|null $diario
 * @property int|null $caja
 * @property int|null $canal
 * @property int $dias
 * @property int|null $numeroregistro
 * @property float|null $basecero
 * @property float|null $baseiva
 * @property float|null $montoiva
 * @property float|null $valoriva
 * @property float|null $ivabienes
 * @property float|null $ivaservicios
 * @property int|null $comprobantefiscal
 * @property string|null $cedula
 * @property int|null $tidentificacion
 * @property float|null $valorretenidoiva
 * @property float|null $valorretenidorenta
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioan
 * @property string|null $fechaan
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property string|null $ncomprobantefiscal
 * @property string|null $nretencion
 * @property int|null $cierrecartera
 * @property int|null $cxcprotesto
 * @property int|null $cxcprotestocar
 * @property int|null $bcoprotestorev
 * @property int|null $bcoprotestocar
 * @property int|null $bcoprotestoori
 * @property int|null $cxcprotestoori
 * @property int|null $movimientocaja
 * @property string|null $autorizacion
 * @property string|null $validez
 * @property string|null $notacreditofis
 * @property string|null $serie
 * @property int|null $origennotacredfis
 * @property int|null $chequeestado
 * @property int|null $depositolote
 * @property int|null $declaracionmov
 * @property string|null $autorizacioncfiscal
 * @property int|null $usuariodeclara
 * @property string|null $fechadeclara
 * @property int|null $anticipoestatus
 * @property float|null $anticipovalor
 * @property float|null $anticiposaldo
 * @property int|null $anticipomov
 * @property string|null $anticipofecha
 * @property int|null $anticipousu
 * @property int|null $motivodev
 * @property int|null $validacioncredara
 * @property int|null $cierreventanum
 * @property string|null $cierreventafec
 * @property int|null $cierreventausu
 * @property string|null $aperturaventafec
 * @property int|null $aperturaventausu
 * @property int $isDeleted
 * @property string $estatus
 *
 * @property Clientes $idcliente0
 * @property User $usuariocreacion0
 */
class Cuentasporcobrar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuentasporcobrar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo', 'idcliente', 'idfactura', 'tipopago', 'fecha', 'usuariocreacion'], 'required'],
            [['tipo', 'concepto', 'diario', 'estatus'], 'string'],
            [['idcliente', 'idfactura', 'tipopago', 'formapago', 'banco', 'cheque', 'tipocheque', 'deposito', 'movimientobanco', 'caja', 'canal', 'dias', 'numeroregistro', 'comprobantefiscal', 'tidentificacion', 'usuariocreacion', 'usuarioan', 'usuarioact', 'cierrecartera', 'cxcprotesto', 'cxcprotestocar', 'bcoprotestorev', 'bcoprotestocar', 'bcoprotestoori', 'cxcprotestoori', 'movimientocaja', 'origennotacredfis', 'chequeestado', 'depositolote', 'declaracionmov', 'usuariodeclara', 'anticipoestatus', 'anticipomov', 'anticipousu', 'motivodev', 'validacioncredara', 'cierreventanum', 'cierreventausu', 'aperturaventausu', 'isDeleted'], 'integer'],
            [['fecha', 'fechacheque', 'vencimiento', 'fechacreacion', 'fechaan', 'fechaact', 'validez', 'fechadeclara', 'anticipofecha', 'cierreventafec', 'aperturaventafec'], 'safe'],
            [['valor', 'abono', 'saldo', 'basecero', 'baseiva', 'montoiva', 'valoriva', 'ivabienes', 'ivaservicios', 'valorretenidoiva', 'valorretenidorenta', 'anticipovalor', 'anticiposaldo'], 'number'],
            [['cuenta', 'notacreditofis', 'serie'], 'string', 'max' => 50],
            [['cedula'], 'string', 'max' => 10],
            [['ncomprobantefiscal', 'nretencion', 'autorizacion', 'autorizacioncfiscal'], 'string', 'max' => 80],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['idcliente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'idcliente' => 'Idcliente',
            'idfactura' => 'Idfactura',
            'tipopago' => 'Tipopago',
            'fecha' => 'Fecha',
            'valor' => 'Valor',
            'abono' => 'Abono',
            'saldo' => 'Saldo',
            'concepto' => 'Concepto',
            'formapago' => 'Formapago',
            'banco' => 'Banco',
            'cheque' => 'Cheque',
            'fechacheque' => 'Fechacheque',
            'tipocheque' => 'Tipocheque',
            'deposito' => 'Deposito',
            'movimientobanco' => 'Movimientobanco',
            'cuenta' => 'Cuenta',
            'vencimiento' => 'Vencimiento',
            'diario' => 'Diario',
            'caja' => 'Caja',
            'canal' => 'Canal',
            'dias' => 'Dias',
            'numeroregistro' => 'Numeroregistro',
            'basecero' => 'Basecero',
            'baseiva' => 'Baseiva',
            'montoiva' => 'Montoiva',
            'valoriva' => 'Valoriva',
            'ivabienes' => 'Ivabienes',
            'ivaservicios' => 'Ivaservicios',
            'comprobantefiscal' => 'Comprobantefiscal',
            'cedula' => 'Cedula',
            'tidentificacion' => 'Tidentificacion',
            'valorretenidoiva' => 'Valorretenidoiva',
            'valorretenidorenta' => 'Valorretenidorenta',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioan' => 'Usuarioan',
            'fechaan' => 'Fechaan',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'ncomprobantefiscal' => 'Ncomprobantefiscal',
            'nretencion' => 'Nretencion',
            'cierrecartera' => 'Cierrecartera',
            'cxcprotesto' => 'Cxcprotesto',
            'cxcprotestocar' => 'Cxcprotestocar',
            'bcoprotestorev' => 'Bcoprotestorev',
            'bcoprotestocar' => 'Bcoprotestocar',
            'bcoprotestoori' => 'Bcoprotestoori',
            'cxcprotestoori' => 'Cxcprotestoori',
            'movimientocaja' => 'Movimientocaja',
            'autorizacion' => 'Autorizacion',
            'validez' => 'Validez',
            'notacreditofis' => 'Notacreditofis',
            'serie' => 'Serie',
            'origennotacredfis' => 'Origennotacredfis',
            'chequeestado' => 'Chequeestado',
            'depositolote' => 'Depositolote',
            'declaracionmov' => 'Declaracionmov',
            'autorizacioncfiscal' => 'Autorizacioncfiscal',
            'usuariodeclara' => 'Usuariodeclara',
            'fechadeclara' => 'Fechadeclara',
            'anticipoestatus' => 'Anticipoestatus',
            'anticipovalor' => 'Anticipovalor',
            'anticiposaldo' => 'Anticiposaldo',
            'anticipomov' => 'Anticipomov',
            'anticipofecha' => 'Anticipofecha',
            'anticipousu' => 'Anticipousu',
            'motivodev' => 'Motivodev',
            'validacioncredara' => 'Validacioncredara',
            'cierreventanum' => 'Cierreventanum',
            'cierreventafec' => 'Cierreventafec',
            'cierreventausu' => 'Cierreventausu',
            'aperturaventafec' => 'Aperturaventafec',
            'aperturaventausu' => 'Aperturaventausu',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Idcliente0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcliente0()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'idcliente']);
    }


    public function getCuentaxcdet()
    {
        return $this->hasMany(Cuentasporcobrardet::className(), ['numerofactura' => 'id']);
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

    public function getUsuariomodificacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuarioact']);
    }

    public function getFormacobro0()
    {
        return $this->hasOne(Formapagocuentas::className(), ['id' => 'formapago']);
    }

  
}
