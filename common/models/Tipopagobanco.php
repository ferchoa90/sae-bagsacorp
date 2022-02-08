<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipopagobanco".
 *
 * @property int $id
 * @property resource $nombre
 * @property int|null $mostrar
 * @property int|null $reporte
 * @property string $sufijo
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int $isDeleted
 * @property string $estatus
 */
class Tipopagobanco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipopagobanco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'sufijo', 'usuariocreacion'], 'required'],
            [['nombre', 'estatus'], 'string'],
            [['mostrar', 'reporte', 'usuariocreacion', 'isDeleted'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['sufijo'], 'string', 'max' => 10],
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
            'mostrar' => 'Mostrar',
            'reporte' => 'Reporte',
            'sufijo' => 'Sufijo',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }
}
