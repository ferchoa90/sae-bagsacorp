<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoinventario".
 *
 * @property int $id
 * @property resource $nombre
 * @property float $signo
 * @property int $contabilizar
 * @property string $sufijo
 * @property int $mostrarinv
 * @property int $filtroinv
 * @property int $importar
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property int $isDeleted
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Tipoinventario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoinventario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'signo', 'sufijo', 'usuariocreacion'], 'required'],
            [['nombre', 'estatus'], 'string'],
            [['signo'], 'number'],
            [['contabilizar', 'mostrarinv', 'filtroinv', 'importar', 'usuariocreacion', 'usuarioact', 'isDeleted'], 'integer'],
            [['fechacreacion', 'fechaact'], 'safe'],
            [['sufijo'], 'string', 'max' => 10],
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
            'signo' => 'Signo',
            'contabilizar' => 'Contabilizar',
            'sufijo' => 'Sufijo',
            'mostrarinv' => 'Mostrarinv',
            'filtroinv' => 'Filtroinv',
            'importar' => 'Importar',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'isDeleted' => 'Is Deleted',
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
