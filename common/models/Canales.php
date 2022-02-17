<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "canales".
 *
 * @property int $id
 * @property resource $nombre
 * @property string $etiqueta
 * @property string $formato
 * @property string|null $devolucion
 * @property int $maxitems
 * @property string $autorizacion
 * @property string $fechaaut
 * @property string $fechaexp
 * @property int $tipocomprobante
 * @property string $secuencia
 * @property string $ultimafactura
 * @property int|null $tiporecibo
 * @property int|null $ats
 * @property int|null $temisionfactura
 * @property string|null $fechacreacion
 * @property int|null $usuariocreacion
 * @property string|null $fechaact
 * @property int|null $usuarioact
 * @property string|null $fechaan
 * @property int|null $usuarioan
 * @property string|null $fechasec
 * @property int|null $usuariosec
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Canales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'canales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nombre', 'etiqueta', 'formato', 'maxitems', 'autorizacion', 'fechaaut', 'fechaexp', 'tipocomprobante', 'secuencia', 'ultimafactura'], 'required'],
            [['id', 'maxitems', 'tipocomprobante', 'tiporecibo', 'ats', 'temisionfactura', 'usuariocreacion', 'usuarioact', 'usuarioan', 'usuariosec'], 'integer'],
            [['nombre', 'estatus'], 'string'],
            [['fechaaut', 'fechaexp', 'fechacreacion', 'fechaact', 'fechaan', 'fechasec'], 'safe'],
            [['etiqueta', 'formato', 'devolucion'], 'string', 'max' => 50],
            [['autorizacion'], 'string', 'max' => 15],
            [['secuencia', 'ultimafactura'], 'string', 'max' => 7],
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
            'etiqueta' => 'Etiqueta',
            'formato' => 'Formato',
            'devolucion' => 'Devolucion',
            'maxitems' => 'Maxitems',
            'autorizacion' => 'Autorizacion',
            'fechaaut' => 'Fechaaut',
            'fechaexp' => 'Fechaexp',
            'tipocomprobante' => 'Tipocomprobante',
            'secuencia' => 'Secuencia',
            'ultimafactura' => 'Ultimafactura',
            'tiporecibo' => 'Tiporecibo',
            'ats' => 'Ats',
            'temisionfactura' => 'Temisionfactura',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'fechaact' => 'Fechaact',
            'usuarioact' => 'Usuarioact',
            'fechaan' => 'Fechaan',
            'usuarioan' => 'Usuarioan',
            'fechasec' => 'Fechasec',
            'usuariosec' => 'Usuariosec',
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

    public function getUsuarioactualizacion0()
    {
        $response=$this->hasOne(User::className(), ['id' => 'usuarioact']);
        if (!$this->usuarioact){ $response=(object) $array; $response->username="No registra";}
        return $response;
    }
}
