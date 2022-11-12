<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Productos;
use common\models\Clientes;
use common\models\Cuentas;
use common\models\Proveedores;
use common\models\Operarios;
use common\models\Transporte;
use backend\components\Botones;
use backend\components\Contabilidad_proveedores;
use backend\components\Operarios as ComponentOperarios;
use backend\components\Transportes;
use backend\models\User;
use yii\helpers\Url;


/**
 * Site controller
 */
class MantenimientosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionClientesreg()

    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $page = "Clientes";

        $model = Clientes::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();

        $arrayResp = array();

        $count = 1;

        foreach ($model as $key => $data) {

            foreach ($data as $id => $text) {


                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;

                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';

                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;

                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
              //  $arrayResp[$key]['cliente'] = $data->cliente->nombres;
                $view='cliente';
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
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
                    if (($id == "cedula") || ($id == "razonsocial") ) { $arrayResp[$key][$id] = $text; }
                    if (  ($id == "direccion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "correo") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "telefono") || ($id == "usuariocreacion")  || ($id == "codigo")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }

                }

            }

            $count++;

        }
        return json_encode($arrayResp);

    }

    public function actionOperarios()
    {
        return $this->render('operarios');
    }

    public function actionTransporte()
    {
        return $this->render('transporte');
    }

    public function actionVeroperarios($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        //var_dump($inventario);
        return $this->render('veroperarios', [
            'operario' => Operarios::find()->where(['id'=>$id])->orderBy(["nombres"=>SORT_ASC])->one(),
            //'modelTeam' => Productos::find()->all(),
        ]);
    
    }

    public function actionVerproveedor($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
 
        return $this->render('verproveedor', [
            'proveedor' => Proveedores::find()->where(['id'=>$id])->orderBy(["nombre"=>SORT_ASC])->one(),
            //'modelTeam' => Productos::find()->all(),
        ]);
    }

    public function actionNuevoproveedor() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $cuentas=Cuentas::find()
            ->where(["isDeleted" => 0,"estatus" => "ACTIVO"])
            ->orderBy(["codigoant" => SORT_ASC])
            ->all();
        $cuentasArray=array();
        $cont = 0;
        foreach ($cuentas as $key => $value) {
            if ($cont == 0) { 
                $cuentasArray[$cont]["value"] = "Seleccione una cuenta";
                $cuentasArray[$cont]["id"] = -1;
                $cont++;
            }
            $cuentasArray[$cont]["value"] = $value->codigoant.' -> '.$value->nombre;
            $cuentasArray[$cont]["id"] = $value->id;
            $cont++;
        }
 
        return $this->render('nuevoproveedor', [
            'cuentas' => $cuentasArray
        ]);
    }

    public function actionEditarproveedor($id) {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $cuentas=Cuentas::find()
            ->where(["isDeleted" => 0,"estatus" => "ACTIVO"])
            ->orderBy(["codigoant" => SORT_ASC])
            ->all();
        $cuentasArray=array();
        $cont = 0;
        foreach ($cuentas as $key => $value) {
            if ($cont == 0) { 
                $cuentasArray[$cont]["value"] = "Seleccione una cuenta";
                $cuentasArray[$cont]["id"] = -1;
                $cont++;
            }
            $cuentasArray[$cont]["value"] = $value->codigoant.' -> '.$value->nombre;
            $cuentasArray[$cont]["id"] = $value->id;
            $cont++;
        }
 
        return $this->render('editarproveedor', [
            'proveedor' => Proveedores::findOne($id),
            'cuentas' => $cuentasArray
        ]);
    }

    public function actionGuardarproveedor() {        
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        if (isset($_POST) and !empty($_POST)) {
            extract($_POST);
            $modulo = new Contabilidad_proveedores;
            $response = $modulo->ProveedorGuardar($_POST);
            return json_encode($response);
        }
    }

    public function actionGuardarOperario() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        if (isset($_POST) and !empty($_POST)) {
            extract($_POST);
            $modulo = new ComponentOperarios();
            $response = $modulo->OperarioGuardar($_POST);
            return json_encode($response);
        }
    }

    public function actionGuardartransporte() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        if (isset($_POST) and !empty($_POST)) {
            extract($_POST);
            $modulo = new Transportes();
            $response = $modulo->TransporteGuardar($_POST);
            return json_encode($response);
        }
    }

    public function actionVertransporte($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
 
        return $this->render('vertransporte', [
            'transporte' => Transporte::find()->where(['id'=>$id])->orderBy(["nombre"=>SORT_ASC])->one(),
            //'modelTeam' => Productos::find()->all(),
        ]);
    
    }

    public function actionNuevotransporte() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
 
        return $this->render('nuevotransporte');
    }

    public function actionEditartransporte($id) {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
 
        return $this->render('editartransporte', [
            'transporte' => Transporte::findOne($id)
        ]);
    }

    public function actionVercliente($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
 
        return $this->render('vercliente', [
            'cliente' => Clientes::find()->where(['id'=>$id])->one(),
            //'modelTeam' => Productos::find()->all(),
        ]);
    
    }

    public function actionProveedoresreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "Proveedores";
        $model = Proveedores::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
              //  $arrayResp[$key]['cliente'] = $data->cliente->nombres;
                $view='proveedor';
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
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
                    if (($id == "nombre") || ($id == "identificacion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "contacto") || ($id == "telefono") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "direccion") || ($id == "credito") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "correo")  ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "debito") || ($id == "usuariocreacion")  || ($id == "codigo")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }

            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionOperariosreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "Operarios";
        $model = Operarios::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
              //  $arrayResp[$key]['cliente'] = $data->cliente->nombres;
                $view='operarios';
                if ($id == "id") {
                    
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombres")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }

                }

            }
            $botonC=$botones->getBotongridArray(
                array(
                  array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$data['id'], 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                  array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'', 'onclick'=>'editarOperario('.$data["id"].',\''.$data["nombres"].'\')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                  array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$data['id']. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                )
              );
            $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
            $count++;
        }



        return json_encode($arrayResp);



    }

    public function actionTransportereg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "Transporte";
        $model = Transporte::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
              //  $arrayResp[$key]['cliente'] = $data->cliente->nombres;
                $view='transporte';
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
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
                    if (($id == "nombre") || ($id == "telefonos") || ($id == "placa")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "direccion") || ($id == "contacto") || ($id == "ruc")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }

                }

            }

            $count++;

        }



        return json_encode($arrayResp);



    }
    

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index3');
    }

    public function actionClientes()
    {
        return $this->render('clientes');
    }

    public function actionProveedores()
    {
        return $this->render('proveedores');
    }

    public function actionOperarioseliminar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $model = Operarios::findOne($id);
        $model->isDeleted = 1;

        if ($model->save())
        {
            return true;
        }else{
            return false;
        }
        //return $this->redirect(['index']);
    }

    public function actionProveedoreliminar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $model = Proveedores::findOne($id);
        $model->isDeleted = 1;

        if ($model->save())
        {
            return true;
        }else{
            return false;
        }
        //return $this->redirect(['index']);
    }



    /**
     * Login action.
     *
     * @return string
     */

}
