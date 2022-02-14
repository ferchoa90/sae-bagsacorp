<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $id
 * @property string $codigo
 * @property string|null $codigonew
 * @property string $nombreproducto
 * @property int|null $tipo
 * @property int $tipoproducto
 * @property int|null $idpresentacion
 * @property float|null $descuento
 * @property int|null $grabaiva
 * @property float|null $stockinicial
 * @property float|null $stockactual
 * @property float|null $stockmaximo
 * @property float|null $stockminimo
 * @property float|null $costoant
 * @property float|null $costoini
 * @property float|null $costo
 * @property float|null $costofob
 * @property float|null $precio
 * @property float|null $preciodist2
 * @property float|null $preciodist3
 * @property float|null $preciopvp
 * @property float|null $inicialant
 * @property string|null $caracteristicas
 * @property int|null $idproveedor
 * @property string|null $ultimacompra
 * @property int|null $numeroultc
 * @property int|null $cantidadultc
 * @property float|null $unibulto
 * @property string|null $ultimaventa
 * @property string|null $imagen
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property int|null $usuarioan
 * @property string|null $fechaan
 * @property float|null $facturacost
 * @property float|null $porfacturacost
 * @property int|null $usuactprecio
 * @property string|null $fechaactprecio
 * @property int|null $idpresentacionsec
 * @property float|null $coeficiente
 * @property float|null $preciomayor
 * @property int|null $caracteristica
 * @property float|null $noinccosteo
 * @property int|null $usuarioactcosto
 * @property string|null $fechaactcosto
 * @property float|null $costoprod
 * @property float|null $materialprep
 * @property float|null $desperdicio
 * @property string|null $codigoalterno
 * @property int|null $marca
 * @property resource|null $codigoprov
 * @property int|null $color
 * @property float|null $costototprod
 * @property int|null $unidadsechabil
 * @property int|null $unidadsecinv
 * @property int|null $unidadsecinvdesde
 * @property int|null $unidadsecinvhasta
 * @property int|null $unidadseccostounit
 * @property int|null $unidadseccostoprod
 * @property int|null $unidadseccostounitant
 * @property int|null $tiempotarea
 * @property int|null $iddepartamento
 * @property int|null $area
 * @property int|null $actualizaprecio
 * @property int $modelo
 * @property int $idempresa
 * @property int $isDeleted
 * @property string $estatus
 *
 * @property Empresa $idempresa0
 * @property Menurestaurante[] $menurestaurantes
 * @property Menurestaurante[] $menurestaurantes0
 * @property Menurestaurante[] $menurestaurantes1
 * @property Menurestaurante[] $menurestaurantes2
 * @property Modelo $modelo0
 * @property Pedidosdetalle[] $pedidosdetalles
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'nombreproducto', 'tipoproducto', 'idempresa'], 'required'],
            [['tipo', 'tipoproducto', 'idpresentacion', 'grabaiva', 'idproveedor', 'numeroultc', 'cantidadultc', 'usuariocreacion', 'usuarioact', 'usuarioan', 'usuactprecio', 'idpresentacionsec', 'caracteristica', 'usuarioactcosto', 'marca', 'color', 'unidadsechabil', 'unidadsecinv', 'unidadsecinvdesde', 'unidadsecinvhasta', 'unidadseccostounit', 'unidadseccostoprod', 'unidadseccostounitant', 'tiempotarea', 'iddepartamento', 'area', 'actualizaprecio', 'modelo', 'idempresa', 'isDeleted'], 'integer'],
            [['descuento', 'stockinicial', 'stockactual', 'stockmaximo', 'stockminimo', 'costoant', 'costoini', 'costo', 'costofob', 'precio', 'preciodist2', 'preciodist3', 'preciopvp', 'inicialant', 'unibulto', 'facturacost', 'porfacturacost', 'coeficiente', 'preciomayor', 'noinccosteo', 'costoprod', 'materialprep', 'desperdicio', 'costototprod'], 'number'],
            [['ultimacompra', 'ultimaventa', 'fechacreacion', 'fechaact', 'fechaan', 'fechaactprecio', 'fechaactcosto'], 'safe'],
            [['codigoprov', 'estatus'], 'string'],
            [['codigo', 'codigonew', 'codigoalterno'], 'string', 'max' => 50],
            [['nombreproducto', 'caracteristicas'], 'string', 'max' => 200],
            [['imagen'], 'string', 'max' => 100],
            [['idempresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['idempresa' => 'id']],
            [['modelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['modelo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'codigonew' => 'Codigonew',
            'nombreproducto' => 'Nombreproducto',
            'tipo' => 'Tipo',
            'tipoproducto' => 'Tipoproducto',
            'idpresentacion' => 'Idpresentacion',
            'descuento' => 'Descuento',
            'grabaiva' => 'Grabaiva',
            'stockinicial' => 'Stockinicial',
            'stockactual' => 'Stockactual',
            'stockmaximo' => 'Stockmaximo',
            'stockminimo' => 'Stockminimo',
            'costoant' => 'Costoant',
            'costoini' => 'Costoini',
            'costo' => 'Costo',
            'costofob' => 'Costofob',
            'precio' => 'Precio',
            'preciodist2' => 'Preciodist2',
            'preciodist3' => 'Preciodist3',
            'preciopvp' => 'Preciopvp',
            'inicialant' => 'Inicialant',
            'caracteristicas' => 'Caracteristicas',
            'idproveedor' => 'Idproveedor',
            'ultimacompra' => 'Ultimacompra',
            'numeroultc' => 'Numeroultc',
            'cantidadultc' => 'Cantidadultc',
            'unibulto' => 'Unibulto',
            'ultimaventa' => 'Ultimaventa',
            'imagen' => 'Imagen',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'usuarioan' => 'Usuarioan',
            'fechaan' => 'Fechaan',
            'facturacost' => 'Facturacost',
            'porfacturacost' => 'Porfacturacost',
            'usuactprecio' => 'Usuactprecio',
            'fechaactprecio' => 'Fechaactprecio',
            'idpresentacionsec' => 'Idpresentacionsec',
            'coeficiente' => 'Coeficiente',
            'preciomayor' => 'Preciomayor',
            'caracteristica' => 'Caracteristica',
            'noinccosteo' => 'Noinccosteo',
            'usuarioactcosto' => 'Usuarioactcosto',
            'fechaactcosto' => 'Fechaactcosto',
            'costoprod' => 'Costoprod',
            'materialprep' => 'Materialprep',
            'desperdicio' => 'Desperdicio',
            'codigoalterno' => 'Codigoalterno',
            'marca' => 'Marca',
            'codigoprov' => 'Codigoprov',
            'color' => 'Color',
            'costototprod' => 'Costototprod',
            'unidadsechabil' => 'Unidadsechabil',
            'unidadsecinv' => 'Unidadsecinv',
            'unidadsecinvdesde' => 'Unidadsecinvdesde',
            'unidadsecinvhasta' => 'Unidadsecinvhasta',
            'unidadseccostounit' => 'Unidadseccostounit',
            'unidadseccostoprod' => 'Unidadseccostoprod',
            'unidadseccostounitant' => 'Unidadseccostounitant',
            'tiempotarea' => 'Tiempotarea',
            'iddepartamento' => 'Iddepartamento',
            'area' => 'Area',
            'actualizaprecio' => 'Actualizaprecio',
            'modelo' => 'Modelo',
            'idempresa' => 'Idempresa',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }
 /**
     * Gets query for [[Idempresa0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdempresa0()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'idempresa']);
    }

 
    /**
     * Gets query for [[Pedidosdetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidosdetalles()
    {
        return $this->hasMany(Pedidosdetalle::className(), ['idproducto' => 'id']);
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['idproducto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoproducto0()
    {
        return $this->hasOne(Tipoproducto::className(), ['id' => 'tipoproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'idempresa']);
    }

    public function getColor0()
    {
        return $this->hasOne(Color::className(), ['id' => 'color']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedores::className(), ['id' => 'idproveedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarca0()
    {
        return $this->hasOne(Marca::className(), ['id' => 'marca']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelo0()
    {
        return $this->hasOne(Modelo::className(), ['id' => 'modelo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function getPresentacion0()
    {
        return $this->hasOne(Presentacion::className(), ['id' => 'idpresentacion']);
    }

    public function getTipounidad0()
    {
        return $this->hasOne(Tipounidad::className(), ['id' => 'idpresentacion']);
    }

    public function getTipounidadsec0()
    {
        return $this->hasOne(Tipounidad::className(), ['id' => 'idpresentacionsec']);
    }
    

    public function getCaracteristica0()
    {
        return $this->hasOne(Caracteristica::className(), ['id' => 'caracteristica']);
    }


    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }

    public function getUsuarioactualizacion0()
    {
        $response=$this->hasOne(User::className(), ['id' => 'usuarioact']);
        if (!$this->usuarioact){ $response=(object) $array; $response->username="No registra";}
        return $response;
    }
}
