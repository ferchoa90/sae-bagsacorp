<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "facturaelectronica".
 *
 * @property int $id
 * @property int $nfactura
 * @property int|null $canal
 * @property int|null $tipomov
 * @property string|null $fecha
 * @property string|null $hora
 * @property int|null $tipoprecio
 * @property int|null $idcliente
 * @property int|null $diasplazo
 * @property string|null $firma
 * @property resource|null $condiciones
 * @property int|null $entrega
 * @property float|null $costo
 * @property float|null $subtotal
 * @property float|null $total
 * @property int|null $tipopago
 * @property string|null $cancela
 * @property float|null $descuento
 * @property float|null $iva
 * @property int|null $transporte
 * @property resource|null $referencia
 * @property string|null $vencimiento
 * @property resource|null $notas
 * @property int|null $vendedor
 * @property int|null $bodegaorigen
 * @property int|null $bodegadestino
 * @property string|null $cartera
 * @property string|null $autorizacionant
 * @property string|null $validez
 * @property int|null $retencion
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property int|null $usuarioan
 * @property string|null $fechaan
 * @property int|null $codigotransporte
 * @property float|null $decuentoglobal
 * @property string|null $diario
 * @property int $cuotas
 * @property int|null $notascredito
 * @property float $ivavalor
 * @property float $totalivagravado
 * @property float $totalivaice
 * @property int $motivosan
 * @property int|null $asignardetalles
 * @property int|null $notasalpie
 * @property int|null $motivoanul
 * @property int|null $movimientoctaxp
 * @property int|null $declaracionmov
 * @property int|null $autorizacionfac
 * @property int|null $autorizacionusu
 * @property int|null $declarausu
 * @property string|null $fechadeclaracion
 * @property int|null $guiaremision
 * @property int|null $usuarioguia
 * @property string|null $fechaguiarem
 * @property int|null $numeroentrega
 * @property int|null $usuarioimp
 * @property string|null $fechaimpresion
 * @property int $tipodescuento
 * @property int $proforma
 * @property int $tipodoc
 * @property string|null $nombres
 * @property string|null $ruc
 * @property string $enviadoenlinea
 * @property string $enviadosri
 * @property resource|null $autorizacion
 * @property resource|null $claveacceso
 * @property int $isDeleted
 * @property string $facturae
 * @property string $estatus
 */
class Facturaelectronica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facturaelectronica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nfactura'], 'required'],
            [['nfactura', 'canal', 'tipomov', 'tipoprecio', 'idcliente', 'diasplazo', 'entrega', 'tipopago', 'transporte', 'vendedor', 'bodegaorigen', 'bodegadestino', 'retencion', 'usuariocreacion', 'usuarioact', 'usuarioan', 'codigotransporte', 'cuotas', 'notascredito', 'motivosan', 'asignardetalles', 'notasalpie', 'motivoanul', 'movimientoctaxp', 'declaracionmov', 'autorizacionfac', 'autorizacionusu', 'declarausu', 'guiaremision', 'usuarioguia', 'numeroentrega', 'usuarioimp', 'tipodescuento', 'proforma', 'tipodoc', 'isDeleted'], 'integer'],
            [['fecha', 'hora', 'vencimiento', 'validez', 'fechacreacion', 'fechaact', 'fechaan', 'fechadeclaracion', 'fechaguiarem', 'fechaimpresion'], 'safe'],
            [['condiciones', 'referencia', 'notas', 'enviadoenlinea', 'enviadosri', 'autorizacion', 'claveacceso', 'facturae', 'estatus'], 'string'],
            [['costo', 'subtotal', 'total', 'descuento', 'iva', 'decuentoglobal', 'ivavalor', 'totalivagravado', 'totalivaice'], 'number'],
            [['firma', 'diario'], 'string', 'max' => 80],
            [['cancela', 'cartera', 'autorizacionant'], 'string', 'max' => 50],
            [['nombres'], 'string', 'max' => 350],
            [['ruc'], 'string', 'max' => 13],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nfactura' => 'Nfactura',
            'canal' => 'Canal',
            'tipomov' => 'Tipomov',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
            'tipoprecio' => 'Tipoprecio',
            'idcliente' => 'Idcliente',
            'diasplazo' => 'Diasplazo',
            'firma' => 'Firma',
            'condiciones' => 'Condiciones',
            'entrega' => 'Entrega',
            'costo' => 'Costo',
            'subtotal' => 'Subtotal',
            'total' => 'Total',
            'tipopago' => 'Tipopago',
            'cancela' => 'Cancela',
            'descuento' => 'Descuento',
            'iva' => 'Iva',
            'transporte' => 'Transporte',
            'referencia' => 'Referencia',
            'vencimiento' => 'Vencimiento',
            'notas' => 'Notas',
            'vendedor' => 'Vendedor',
            'bodegaorigen' => 'Bodegaorigen',
            'bodegadestino' => 'Bodegadestino',
            'cartera' => 'Cartera',
            'autorizacionant' => 'Autorizacionant',
            'validez' => 'Validez',
            'retencion' => 'Retencion',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'usuarioan' => 'Usuarioan',
            'fechaan' => 'Fechaan',
            'codigotransporte' => 'Codigotransporte',
            'decuentoglobal' => 'Decuentoglobal',
            'diario' => 'Diario',
            'cuotas' => 'Cuotas',
            'notascredito' => 'Notascredito',
            'ivavalor' => 'Ivavalor',
            'totalivagravado' => 'Totalivagravado',
            'totalivaice' => 'Totalivaice',
            'motivosan' => 'Motivosan',
            'asignardetalles' => 'Asignardetalles',
            'notasalpie' => 'Notasalpie',
            'motivoanul' => 'Motivoanul',
            'movimientoctaxp' => 'Movimientoctaxp',
            'declaracionmov' => 'Declaracionmov',
            'autorizacionfac' => 'Autorizacionfac',
            'autorizacionusu' => 'Autorizacionusu',
            'declarausu' => 'Declarausu',
            'fechadeclaracion' => 'Fechadeclaracion',
            'guiaremision' => 'Guiaremision',
            'usuarioguia' => 'Usuarioguia',
            'fechaguiarem' => 'Fechaguiarem',
            'numeroentrega' => 'Numeroentrega',
            'usuarioimp' => 'Usuarioimp',
            'fechaimpresion' => 'Fechaimpresion',
            'tipodescuento' => 'Tipodescuento',
            'proforma' => 'Proforma',
            'tipodoc' => 'Tipodoc',
            'nombres' => 'Nombres',
            'ruc' => 'Ruc',
            'enviadoenlinea' => 'Enviadoenlinea',
            'enviadosri' => 'Enviadosri',
            'autorizacion' => 'Autorizacion',
            'claveacceso' => 'Claveacceso',
            'isDeleted' => 'Is Deleted',
            'facturae' => 'Facturae',
            'estatus' => 'Estatus',
        ];
    }

    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipodoc0()
    {
        return $this->hasOne(Tipodocumento::className(), ['id' => 'tipodoc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipopago0()
    {
        return $this->hasOne(Tipopago::className(), ['id' => 'tipopago']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'idcliente']);
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturadetalle()
    {
        return $this->hasMany(Facturadetalle::className(), ['idfactura' => 'nfactura']);
    }

    public function getTipoprecio0()
    {
        return $this->hasOne(Tipopreciofactura::className(), ['id' => 'tipoprecio']);
    }

    public function getdiario0()
    {
        //echo '2021-'.$this->nfactura;
        //var_dump(Diario::find()->where(['auxiliar' => $this->nfactura,'anio'=>'2021'])->one());
        return Diario::find()->where(['auxiliar' =>$this->nfactura,'anio'=> substr($this->fecha,0,4)])->one();
        //return $this->hasOne(Diario::className(), ['auxiliar' => 'nfactura']);
    }

    public function getcpc0()
    {
        //echo '2021-'.$this->nfactura;

        //echo (Cuentasporcobrar::find()->where(['idfactura' => $this->nfactura,'tipo'=>'D'])->one()->concepto);
        return Cuentasporcobrar::find()->where(['idfactura' =>$this->nfactura,'tipo'=>'D'])->one();
        //return $this->hasOne(Diario::className(), ['auxiliar' => 'nfactura']);
    }

    
    public function getUsuarioactualizacion0()
    {
        $response=$this->hasOne(User::className(), ['id' => 'usuarioact']);
        if (!$this->usuarioact){ $response=(object) $array; $response->username="No registra";}
        return $response;
    }
}
