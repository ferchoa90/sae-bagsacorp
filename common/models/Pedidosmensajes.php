<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pedidosmensajes".
 *
 * @property int $id
 * @property int $idpedido
 * @property int $idusuarioorg
 * @property int $idusuariodes
 * @property resource|null $mensaje
 * @property resource|null $estatuspedido
 * @property int $isDeleted
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Pedidos $idpedido0
 * @property User $idusuariodes0
 * @property User $idusuarioorg0
 * @property User $usuariocreacion0
 */
class Pedidosmensajes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidosmensajes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpedido', 'idusuarioorg', 'idusuariodes', 'usuariocreacion'], 'required'],
            [['idpedido', 'idusuarioorg', 'idusuariodes', 'isDeleted', 'usuariocreacion'], 'integer'],
            [['mensaje', 'estatuspedido', 'estatus'], 'string'],
            [['fechacreacion'], 'safe'],
            [['idpedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['idpedido' => 'id']],
            [['idusuarioorg'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idusuarioorg' => 'id']],
            [['idusuariodes'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idusuariodes' => 'id']],
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
            'idpedido' => 'Idpedido',
            'idusuarioorg' => 'Idusuarioorg',
            'idusuariodes' => 'Idusuariodes',
            'mensaje' => 'Mensaje',
            'estatuspedido' => 'Estatuspedido',
            'isDeleted' => 'Is Deleted',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Idpedido0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdpedido0()
    {
        return $this->hasOne(Pedidos::className(), ['id' => 'idpedido']);
    }

    /**
     * Gets query for [[Idusuariodes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdusuariodes0()
    {
        return $this->hasOne(User::className(), ['id' => 'idusuariodes']);
    }

    /**
     * Gets query for [[Idusuarioorg0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdusuarioorg0()
    {
        return $this->hasOne(User::className(), ['id' => 'idusuarioorg']);
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
}
