<?php

namespace backend\controllers;
use backend\components\Globaldata;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\db\Query;
use common\models\Inventario;
use common\models\Factura;
use common\models\Cuentasporcobrar;
use common\models\Cuentasporpagar;
use common\models\Cuentasporpagardet;
use common\models\Cuentasporcobrardet;
use common\models\Banco;
use common\models\Diario;
use common\models\Retencioncxc;
use common\models\Retenciones;
use common\models\Presentacion;
use common\models\Productos;
use common\models\Pedidos;
use common\models\Horariocomidas;
use common\models\Departamentos;
use common\models\Clientes;
use backend\components\Contabilidad_clientes;
use backend\components\Contabilidad_proveedores;
use backend\components\Produccion_pedidos;
use backend\models\User;
use kartik\export\ExportMenu;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\data\ArrayDataProvider;
use backend\components\Botones;

class VentasController extends Controller

{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'view', 'delete', 'index'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'view', 'delete', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**

     * Renders the index view for the module

     * @return string

     */
    public function actionIndex()
    {
        return $this->render('index',[

        ]);
    }

    public function actionPedidos()
    {
        //$clientes= new Contabilidad_clientes;
        //$clientes= $clientes->getSelect();
        return $this->render('pedidos',[
            //'clientes'=>$clientes,
        ]);
    }


    public function actionReimpresion()
    {
        return $this->render('reimpresion');
    }

    public function actionPedidosreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "pedidos";
        $view=$page;
        $model = Pedidos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;
                $editar=array(); $borrar=array();
                if (($id == "estatuspedido") && ($text=="NUEVO"  && $text=="DEVUELTO") ) {
                    $editar=array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>'');
                }
                if (($id == "estatuspedido") && ($text=="NUEVO") ) {
                    $borrar=array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>'');
                }

                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          $editar,
                          $borrar,
                        )
                      );
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {

                    if (($id == "nombres")  || ($id == "direccion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "telefono") || ($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "subtotal") || ($id == "iva") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "total") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }

                    if ($id == "estatusproduccion") {
                        switch ($text) {
                            case 'RECIBIDO':
                                $style='badge-info';
                                break;

                            case 'NO INICIADO':
                                    $style='badge-primary';
                                    break;


                            default:
                                # code...
                                break;
                        }
                        $arrayResp[$key][$id] = '<small class="badge '.$style.'" style="color:white"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                    }

                    if ($id == "estatuspedido") {
                        switch ($text) {
                            case 'NUEVO':
                                $style='badge-primary';
                                break;

                            case 'ENVIADO':
                                    $style='badge-primary';
                                    break;

                                case 'AUTORIZADO':
                                    $style='badge-success';
                                    break;

                            case 'REENVIADO':
                                $style='badge-primary';
                                break;

                            case 'NO AUTORIZADO':
                                $style='badge-danger';
                                break;

                            case 'POR APROBAR':
                                $style='badge-secondary';
                                break;

                            case 'DEVUELTO':
                                $style='badge-warning';
                                break;

                            default:
                                # code...
                                break;
                        }
                        $arrayResp[$key][$id] = '<small class="badge '.$style.'" style="color:white"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                    }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionGestionarpedido()
    {
        extract($_POST);
        $arrayResp=array();
        if ($estado && $pedido){
            switch ($estado) {
                case 'AUTORIZAR':
                    $estado="AUTORIZADO";
                    break;

                case 'DEVOLVER':
                    $estado="DEVUELTO";
                    break;

                case 'CANCELAR':
                    $estado="CANCELADO";
                    break;

                default:
                    # code...
                    break;
            }
            $modelPedido=Pedidos::find()->where(['id' => $pedido, "isDeleted" => 0])->one();
            if ($modelPedido){
                $modelPedido->estatuspedido=$estado;
                if ($modelPedido->save()){
                    $arrayResp=array("success"=>true);
                }else{
                    $arrayResp=array("success"=>false);
                }
            }

        }
        return json_encode($arrayResp);
    }

    public function actionFormnuevopedido()
    {
        extract($_POST);
        $arrayResp=array();
        if ($_POST){
            $pedido= new Produccion_pedidos;
            $pedido= $pedido->Nuevo($_POST);
            //die(var_dump($_POST));
            $response=$pedido;

            //return $this->render('formrol');
            return json_encode($response);

        }
        return json_encode($arrayResp);
    }

    public function actionVerpedidos($id)
    {
        $pedido= Pedidos::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('verpedido', [
            'pedido' =>$pedido,
           // 'entregasdetalle' => Diariodetalle::find()->where(['diario' => $entregas->diario, "isDeleted" => 0])->all(),
        ]);

    }

    public function actionNuevopedido()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        //$menuadmin = Menuadmin::find()->where(['isDeleted' => '0'])->orderBy(["nombre" => SORT_ASC])->all();
        $productos = Productos::find()->where(['isDeleted' => '0',"isDeleted"=>"0"])->orderBy(["nombreproducto" => SORT_ASC])->all();
        $productosArray=array();
        $cont=0;
        foreach ($productos as $key => $value) {
            if ($cont==0){ $productosArray[$cont]["value"]="Seleccione producto"; $productosArray[$cont]["id"]=0; $cont++; }
            $productosArray[$cont]["value"]=$value->nombreproducto;
            $productosArray[$cont]["id"]=$value->id;
            $cont++;
        }

        $clientes = Clientes::find()->where(['isDeleted' => '0',"isDeleted"=>"0"])->orderBy(["razonsocial" => SORT_ASC])->all();
        $clientesArray=array();
        $cont=0;
        foreach ($clientes as $key => $value) {
            if ($cont==0){ $clientesArray[$cont]["value"]="Seleccione un cliente"; $clientesArray[$cont]["id"]=0; $cont++; }
            $clientesArray[$cont]["value"]=$value->razonsocial;
            $clientesArray[$cont]["id"]=$value->id;
            $cont++;
        }

        return $this->render('nuevopedido', [
            //'sucursal' => $sucursal,
            'clientes' => $clientesArray,
            'productos' => $productosArray,
        ]);
    }


}
