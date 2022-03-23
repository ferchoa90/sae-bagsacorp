<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pedidosprod".
 *
 * @property int $id
 * @property int $idpedido
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string|null $fechaact
 * @property int|null $usuarioact
 * @property string $estatuspedido
 * @property string $estatus
 *
 * @property Pedidos $idpedido0
 * @property Ordenprod[] $ordenprods
 * @property User $usuariocreacion0
 */
class Pedidosprod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidosprod';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpedido', 'usuariocreacion'], 'required'],
            [['idpedido', 'isDeleted', 'usuariocreacion', 'usuarioact'], 'integer'],
            [['fechacreacion', 'fechaact'], 'safe'],
            [['estatuspedido', 'estatus'], 'string'],
            [['idpedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['idpedido' => 'id']],
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
            'isDeleted' => 'Is Deleted',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'fechaact' => 'Fechaact',
            'usuarioact' => 'Usuarioact',
            'estatuspedido' => 'Estatuspedido',
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
     * Gets query for [[Ordenprods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenprods()
    {
        return $this->hasMany(Ordenprod::className(), ['idpedidoprod' => 'id']);
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
