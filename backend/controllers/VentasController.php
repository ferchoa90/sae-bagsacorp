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
use common\models\PedidosMensajes;
use common\models\Horariocomidas;
use common\models\Departamentos;
use common\models\Clientes;
use common\models\Ordenprod;
use common\models\Pedidosprod;
use backend\components\Contabilidad_clientes;
use backend\components\Contabilidad_proveedores;
use backend\components\Archivos;
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

    public function actionEditarpedidos($id)
    {
        $Modelpedido=  Pedidos::find()->where(["id"=>$id,'isDeleted' => '0'])->one();

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


        return $this->render('editarpedidos',[
            'pedido'=>$Modelpedido,
            'clientes'=>$clientesArray,
            'productos'=>$productosArray,
        ]);
    }


    public function actionReimpresion()
    {
        return $this->render('reimpresion');
    }

    public function actionOrdenesproduccion()
    {
        return $this->render('ordenesproduccion');
    }

    public function actionPedidosproduccion()
    {
        return $this->render('pedidosproduccion');
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
                $editar=array(); $borrar=array();$archivo=array();$facturar=array();
                if ($data["estatuspedido"]=="NUEVO"  || $data["estatuspedido"]=="DEVUELTO") {
                    $editar=array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$data["id"], 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>'');
                }

                if ($data["estatuspedido"]=="AUTORIZADO") {
                    $facturar=array('tipo'=>'link','nombre'=>'generar', 'id' => 'generar', 'titulo'=>'', 'link'=>'/backend/web/facturacion/nuevafactura', 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'naranja', 'icono'=>'pdf','tamanio'=>'superp', 'adicional'=>'');
                }
                if ($data["estatuspedido"]=="NUEVO") {
                    $borrar=array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'eliminar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$data["id"]. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>'');
                }

                if ($data["imagen"] ) {
                    $archivo=array('tipo'=>'link','nombre'=>'archivo', 'id' => 'archivo', 'titulo'=>'', 'link'=>'/backend/web/images/pedidos/'.$data["imagen"] ,'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'plomo', 'icono'=>'archivo','tamanio'=>'superp', 'target'=>'blank','adicional'=>'');
                }
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;


                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'ver', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          $editar,
                          $borrar,
                          $archivo,
                          $facturar,
                        )
                      );
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'CERRADO') {
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

                                    case 'PROC PRODUCCION':
                                        $style='badge-primary';
                                        break;


                            default:
                                # code...
                                break;
                        }
                        $arrayResp[$key][$id] = '<small class="badge '.$style.'" style="color:white"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                    }

                    if ($id == "estatuspedido") {
                        $estatuspedido= New Produccion_pedidos;
                        $style=$estatuspedido->estatus($text);
                        $arrayResp[$key][$id] = '<small class="badge '.$style.'" style="color:white"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                    }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }


    public function actionOrdenesprodreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "ordenesprod";
        $view=$page;
        $model = Ordenprod::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
                $editar=array(); $borrar=array();$archivo=array();$facturar=array();
                if ($data["estatusorden"]=="NUEVO"  || $data["estatusorden"]=="DEVUELTO") {
                    //$editar=array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$data["id"], 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>'');
                }

                if ($data["estatusorden"]=="AUTORIZADO") {
                    $facturar=array('tipo'=>'link','nombre'=>'generar', 'id' => 'generar', 'titulo'=>'', 'link'=>'/backend/web/facturacion/nuevafactura', 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'naranja', 'icono'=>'pdf','tamanio'=>'superp', 'adicional'=>'');
                }
                if ($data["estatusorden"]=="NUEVO") {
                    $borrar=array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'eliminar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$data["id"]. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>'');
                }

               
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;


                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'ver', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          $editar,
                          $borrar,
                          $archivo,
                          $facturar,
                        )
                      );
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'CERRADO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {

                 
                    if (($id == "usuariocreacion") || ($id == "idpedido") ) { $arrayResp[$key][$id] = $text; }
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

                    if ($id == "estatusorden") {
                        $estatuspedido= New Produccion_pedidos;
                        $style=$estatuspedido->estatus($text);
                        $arrayResp[$key][$id] = '<small class="badge '.$style.'" style="color:white"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                    }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionPedidosprodreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "pedidosprod";
        $view=$page;
        $model = Pedidosprod::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
                $editar=array(); $borrar=array();$archivo=array();$facturar=array();
                if ($data["estatuspedido"]=="NUEVO"  || $data["estatuspedido"]=="DEVUELTO") {
                    //$editar=array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$data["id"], 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>'');
                }

                if ($data["estatuspedido"]=="AUTORIZADO") {
                    $facturar=array('tipo'=>'link','nombre'=>'generar', 'id' => 'generar', 'titulo'=>'', 'link'=>'/backend/web/facturacion/nuevafactura', 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'naranja', 'icono'=>'pdf','tamanio'=>'superp', 'adicional'=>'');
                }
                if ($data["estatuspedido"]=="NUEVO") {
                    $borrar=array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'eliminar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$data["id"]. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>'');
                }

               
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;


                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'ver', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          $editar,
                          $borrar,
                          $archivo,
                          $facturar,
                        )
                      );
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'CERRADO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {

                 
                    if (($id == "usuariocreacion") || ($id == "idpedido") ) { $arrayResp[$key][$id] = $text; }
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
                        $estatuspedido= New Produccion_pedidos;
                        $style=$estatuspedido->estatus($text);
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

                case 'ANULAR':
                    $estado="ANULADO";
                    break;

                default:
                    # code...
                    break;
            }
            $modelPedido=Pedidos::find()->where(['id' => $pedido, "isDeleted" => 0])->one();
            $modelPedido->estatuspedido=$estado;
            if ($modelPedido && ($estado=="DEVUELTO" || $estado=="ANULADO")){
                $mensajePedido= New Pedidosmensajes;
                $mensajePedido->idpedido=$pedido;
                $mensajePedido->usuariocreacion=Yii::$app->user->identity->id;
                $mensajePedido->idusuarioorg=Yii::$app->user->identity->id;
                $mensajePedido->idusuariodes=55;
                $mensajePedido->mensaje=$mensaje;
                $mensajePedido->isDeleted=0;
                $mensajePedido->estatus="ACTIVO";
                if  ($mensajePedido->save()){
                    if ($modelPedido->save()){
                        $arrayResp=array("success"=>true);
                    }else{
                        $arrayResp=array("success"=>false);
                    }
                }else{
                    $arrayResp=array("success"=>false, "error" => $mensajePedido->errors);
                }

            }else{
                if ($modelPedido->save()){
                    $arrayResp=array("success"=>true);
                }else{
                    $arrayResp=array("success"=>false);
                }
            }

        }
        return json_encode($arrayResp);
    }

    public function actionGestionarpedidoprod()
    {
        extract($_POST);
        $arrayResp=array();
        if ($estado && $pedido){
            switch ($estado) {
                case 'GENERAR':
                    $estado="GENERADO";
                    $estatuspedidoprod="PROC PRODUCCIÓN";
                    $estatuspedido="EN PRODUCCIÓN";
                    break;

                case 'DEVOLVER':
                    $estado="DEVUELTO";
                    break;

                case 'CANCELAR':
                    $estado="CANCELADO";
                    break;

                case 'ANULAR':
                    $estado="ANULADO";
                    break;

                default:
                    # code...
                    break;
            }
            $modelPedidop=Pedidosprod::find()->where(['id' => $pedido, "isDeleted" => 0])->one();
            $modelPedidop->estatuspedido=$estado;
          
                if  ($modelPedidop->save()){
                    $modelPedido=Pedidos::find()->where(['id' => $modelPedidop->idpedido, "isDeleted" => 0])->one();
                    $modelPedido->estatusproduccion=$estatuspedidoprod;
                        if  ($modelPedido->save()){
                            $arrayResp=array("success"=>true);
                        }else{
                            $arrayResp=array("success"=>false, "error" => $modelPedido->errors);    
                        }
                    }else{
                        //$arrayResp=array("success"=>false);
                        $arrayResp=array("success"=>false, "error" => $modelPedidop->errors);
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
            $archivoM= new Archivos;
            $archivoM=$archivoM->Subirarchivo($_FILES);
            if ($archivoM["success"])
            {
                $_POST["imagen"]=$archivoM["nombrearchivo"];
                //var_dump($_POST);
                $pedido= $pedido->Nuevo($_POST);
                $response=$pedido;
            }else{
                $response=$archivoM;
            }

            //var_dump($_FILES);
            //die(var_dump($_POST));

            //return $this->render('formrol');
            return json_encode($response);

        }
        return json_encode($arrayResp);
    }

    public function actionFormeditarpedido()
    {
        extract($_POST);
        $arrayResp=array();
        if ($_POST){
            $pedido= new Produccion_pedidos;


            //var_dump($_POST);
            $pedido= $pedido->Actualizar($idpedido,$_POST);
            $response=$pedido;


            //var_dump($_FILES);
            //die(var_dump($_POST));

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


    public function actionVerpedidosprod($id)
    {
        $pedido= Pedidosprod::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('verpedidoprod', [
            'data' =>$pedido,
           // 'entregasdetalle' => Diariodetalle::find()->where(['diario' => $entregas->diario, "isDeleted" => 0])->all(),
        ]);

    }

    public function actionVerordenesprod($id)
    {
        $pedido= Ordenprod::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('verordenesprod', [
            'data' =>$pedido,
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

    public function actionPedidoseliminar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $pedido= new Produccion_pedidos;
        $pedido= $pedido->eliminar($id);

        return $pedido;
        //return $this->redirect(['index']);
    }


}
