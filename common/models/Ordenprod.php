<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ordenprod".
 *
 * @property int $id
 * @property int $idpedido
 * @property int $idpedidoprod
 * @property int $idproducto
 * @property int $cantidadinicial
 * @property int $cantidadfinal
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string|null $fechaact
 * @property int|null $usuarioact
 * @property string $estatusorden
 * @property string $estatus
 *
 * @property Pedidos $idpedido0
 * @property Pedidosprod $idpedidoprod0
 * @property User $usuariocreacion0
 */
class Ordenprod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordenprod';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpedido', 'idpedidoprod', 'idproducto', 'cantidadinicial', 'cantidadfinal', 'usuariocreacion'], 'required'],
            [['idpedido', 'idpedidoprod', 'idproducto', 'cantidadinicial', 'cantidadfinal', 'isDeleted', 'usuariocreacion', 'usuarioact'], 'integer'],
            [['fechacreacion', 'fechaact'], 'safe'],
            [['estatusorden', 'estatus'], 'string'],
            [['idpedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['idpedido' => 'id']],
            [['idpedidoprod'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidosprod::className(), 'targetAttribute' => ['idpedidoprod' => 'id']],
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
            'idpedidoprod' => 'Idpedidoprod',
            'idproducto' => 'Idproducto',
            'cantidadinicial' => 'Cantidadinicial',
            'cantidadfinal' => 'Cantidadfinal',
            'isDeleted' => 'Is Deleted',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'fechaact' => 'Fechaact',
            'usuarioact' => 'Usuarioact',
            'estatusorden' => 'Estatusorden',
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
     * Gets query for [[Idpedidoprod0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdpedidoprod0()
    {
        return $this->hasOne(Pedidosprod::className(), ['id' => 'idpedidoprod']);
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

    public function getPedido0()
    {
        $producto=Pedidos::find()->where(["id"=> $this->idpedido])->one();
        //echo ( $this->idproducto.' - ');
        //return $this->hasOne(Productos::className(), ['id' => 'idproducto']);
        return $producto;

    }
}
