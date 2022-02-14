<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sustentotributario".
 *
 * @property int $id
 * @property string $codigo
 * @property resource $nombre
 * @property resource $tipocomprobante
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property int $isDeleted
 * @property string $estatus
 */
class Sustentotributario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sustentotributario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'tipocomprobante', 'usuariocreacion'], 'required'],
            [['nombre', 'tipocomprobante', 'estatus'], 'string'],
            [['usuariocreacion', 'usuarioact', 'isDeleted'], 'integer'],
            [['fechacreacion', 'fechaact'], 'safe'],
            [['codigo'], 'string', 'max' => 10],
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
            'nombre' => 'Nombre',
            'tipocomprobante' => 'Tipocomprobante',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
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
