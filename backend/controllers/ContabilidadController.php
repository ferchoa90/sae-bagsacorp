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
use backend\models\User;
use common\models\Bancos;
use common\models\Cuentas;
use common\models\Cuentasporcobrar;
use common\models\Cuentasporcobrardet;
use common\models\Cuentasporpagar;
use common\models\Cuentasparametros;
use common\models\Periodofiscal;
use common\models\Cuentastipo;
use common\models\Clientes;
use common\models\Diario;
use common\models\Diariodetalle;
use common\models\Formapagocuentas;
use backend\components\Botones;


class ContabilidadController extends Controller
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
        return $this->render('index');
    }

    public function actionConfigcuentas()
    {
        return $this->render('configcuentas');
    }

    public function actionCuentas()
    {
        return $this->render('cuentas');
    }

    public function actionNuevacuenta()
    {
        $cuentas=Cuentas::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["codigoant" => SORT_ASC])->all();
        $cuentasArray=array();
        $cont=0;
        foreach ($cuentas as $key => $value) {
            if ($cont==0){ $cuentasArray[$cont]["value"]="Seleccione una cuenta"; $cuentasArray[$cont]["id"]=-1; $cont++; } 
            $cuentasArray[$cont]["value"]=$value->codigoant.' -> '.$value->nombre;
            $cuentasArray[$cont]["id"]=$value->id;
            $cont++;
        }

        //var_dump($clientesArray);
        return $this->render('nuevacuenta', [
            'cuentas' => $cuentasArray,
        ]);
    }

    public function actionPeriodofiscal()
    {
        return $this->render('periodofiscal');
    }

    public function actionCuentasporcobrar()
    {
        return $this->render('cuentasporcobrar');
    }

    public function actionCuentasporpagar()
    {
        return $this->render('cuentasporpagar');
    }

    public function actionBancos()
    {
        return $this->render('bancos');
    }

    public function actionAsientos()
    {
        return $this->render('asiento');
    }

    public function actionNuevacuentapc()
    {
        $clientes2=Clientes::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["razonsocial" => SORT_ASC])->all();

        $clientes=$clientes2;
        $clientesArray=array();
        $cont=0;
        foreach ($clientes as $key => $value) {
            if ($cont==0){ $clientesArray[$cont]["value"]="Seleccione un cliente"; $clientesArray[$cont]["id"]=-1; $cont++; } 
            $clientesArray[$cont]["value"]=$value->razonsocial;
            $clientesArray[$cont]["id"]=$value->id;
            $cont++;
        }

        $cuentas=Cuentastipo::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["nombre" => SORT_ASC])->all();
        $cuentasArray=array();
        $cont=0;
        foreach ($cuentas as $key => $value) {
            $cuentasArray[$cont]["value"]=$value->nombre;
            $cuentasArray[$cont]["id"]=$value->id;
            $cont++;
        }

        $bancosArray=array();
        $bancos=Bancos::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["nombre" => SORT_ASC])->all();
        $cont=0;
        foreach ($bancos as $key => $value) {
            if ($cont==0){ $bancosArray[$cont]["value"]="Seleccione un banco"; $bancosArray[$cont]["id"]=-1; $cont++; } 
            $bancosArray[$cont]["value"]=$value->nombre;
            $bancosArray[$cont]["id"]=$value->id;
            $cont++;
        }    

        
        $bancos=Formapagocuentas::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["nombre" => SORT_ASC])->all();
        $formacobroArray=array();
        $cont=0;
        foreach ($bancos as $key => $value) {
            if ($cont==0){ $formacobroArray[$cont]["value"]="Seleccione una forma de cobro"; $formacobroArray[$cont]["id"]=-1; $cont++; } 
            $formacobroArray[$cont]["value"]=$value->nombre;
            $formacobroArray[$cont]["id"]=$value->id;
            $cont++;
        }    

        return $this->render('nuevacuentapc', [
            'tipocuenta' => $cuentasArray,
            'clientes' => $clientesArray,
            'clientes2' => $clientes2,
            'bancos' => $bancosArray,
            'formacobro' => $formacobroArray,
        ]);

    }

    public function actionEditarconfigcuenta($id)
    {
        return $this->render('editarconfigcuenta', [
            'model' => Cuentasparametros::find()->where(['id' => $id, "isDeleted" => 0])->one(),
        ]);

    }

    public function actionVerasiento($id)
    {
        $asiento= Diario::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('verasiento', [
            'asiento' =>$asiento,
            'asientodetalle' => Diariodetalle::find()->where(['diario' => $asiento->diario, "isDeleted" => 0])->all(),
        ]);

    }

    public function actionVerbancos($id)
    {
        $bancos= Bancos::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('verbancos', [
            'bancos' =>$bancos,
            //'bancosdetalle' => Diariodetalle::find()->where(['diario' => $bancos->diario, "isDeleted" => 0])->all(),
        ]);

    }

    public function actionVercuentapc($id)
    {
        $cuenta= Cuentasporcobrar::find()->where(['id' => $id, "isDeleted" => 0])->one();
        
        return $this->render('vercuentapc', [
            'cuenta' =>$cuenta,
            'cuentadetalle' => Cuentasporcobrardet::find()->where(['numero' => $cuenta->id, "isDeleted" => 0])->all(),
        ]);

    }

    public function actionVercuenta($id)
    {
        $cuenta= Cuentas::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('vercuenta', [
            'cuenta' =>$cuenta,
            //'asientodetalle' => Diariodetalle::find()->where(['diario' => $asiento->diario, "isDeleted" => 0])->all(),
        ]);

    }

    public function actionEditarperiodofiscal($id)
    {


        return $this->render('editarperiodofiscal', [
            'model' => Periodofiscal::find()->where(['id' => $id, "isDeleted" => 0])->one(),
        ]);

    }

   public function actionInteracciones()
    {
        return $this->render('interacciones');
    }


    public function actionBancosreg()
    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "bancos";
        $model = Bancos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //($arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                //$arrayResp[$key]['departamento'] = $data->iddepartamento0->nombre;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'verbancos?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarbancos?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = $botonC ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                   //if  ($id == "nombre"){ echo $text;}
                    if (($id == "nombre")  ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }


    public function actionAsientoreg()
    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "eliminarbanco";
        $model = Diario::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->limit(1500)->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                //$arrayResp[$key]['departamento'] = $data->iddepartamento0->nombre;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'verasiento?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarasiento?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = $botonC ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                   //if  ($id == "nombre"){ echo $text;}
                    if (($id == "diario") || ($id == "anio") || ($id == "fecha") || ($id == "concepto")  ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "total") || ($id == "tipoaux")    ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionPeriodofiscalreg()
    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "periodofiscal";
        $model = Periodofiscal::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                //$arrayResp[$key]['departamento'] = $data->iddepartamento0->nombre;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'verperiodofiscal?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarperiodofiscal?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = $botonC ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-light "><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'CERRADO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-danger"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';

                } else {
                   //if  ($id == "nombre"){ echo $text;}
                    if (($id == "descripcion") || ($id == "anioinicio") || ($id == "aniofin")  ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionConfigcuentasreg()
    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "cuentasparametros";
        $model = Cuentasparametros::find()->where(['isDeleted' => '0'])->orderBy(["nombre" => SORT_ASC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //($arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $arrayResp[$key]['cuentacont'] = $data->idcuentacontable0->codigoant;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'verconfigcuenta?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarconfigcuenta?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          //array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = $botonC ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                   //if  ($id == "nombre"){ echo $text;}
                    if (($id == "nombre")  || ($id == "descripcion") || ($id == "cuentacontable") || ($id == "cuentaanticipo")    ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }



    public function actionCuentasporcobrarreg()
    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "cuentasporcobrar";
        $model = Cuentasporcobrar::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->limit(1500)->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                //$arrayResp[$key]['departamento'] = $data->iddepartamento0->nombre;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'vercuentapc?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarcuentapc?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = $botonC ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                   //if  ($id == "nombre"){ echo $text;}
                    if (($id == "idfactura") || ($id == "tipo") || ($id == "fecha")  || ($id == "valor")  || ($id == "abono")  ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "saldo") || ($id == "concepto") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionCuentasporpagarreg()
    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "eliminarbanco";
        $model = Cuentasporpagar::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->limit(10000)->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                //$arrayResp[$key]['departamento'] = $data->iddepartamento0->nombre;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'verfactura?='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarfactura?='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = $botonC ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                   //if  ($id == "nombre"){ echo $text;}
                    if (($id == "idfactura") || ($id == "tipo") || ($id == "fecha")  || ($id == "valor")  || ($id == "abono")  ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "saldo") || ($id == "concepto") || ($id == "cuenta") || ($id == "cheque") || ($id == "fechacheque") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }


    public function actionCuentasreg()
    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "cuentas";
        $model = Cuentas::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //($arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                //$arrayResp[$key]['departamento'] = $data->iddepartamento0->nombre;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'vercuenta?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarcuenta?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          //array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'pequeño', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = $botonC ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                   //if  ($id == "nombre"){ echo $text;}
                    if (($id == "parent") || ($id == "codigoant") || ($id == "codigo") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "saldo") || ($id == "cheque") || ($id == "nombre")  ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionRegistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "libreria";
        $model = Descargables::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $pagina = Paginas::find()->where(['id' => $data->pagina,'isDeleted' => '0'])->one();
                $arrayResp[$key]['num'] = $count;
                $arrayResp[$key]['archivo'] = '<a   src="/frontend/web/images/'.$data->archivo.'"/>'.$data->archivo.'</a>';
                $arrayResp[$key]['pagina']="-";
                if ($pagina){ $arrayResp[$key]['pagina']=$pagina["nombre"]; }
                if ($id == "id") {
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/verdescarga?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/actualizardescarga?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "tipo") || ($id == "link") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "vista") || ($id == "superior") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "orden") || ($id == "estatus") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }

        echo json_encode($arrayResp);
    }

    public function actionBancosregistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "bancos";
        $model = Bancos::find()->where(['isDeleted' => '0'])->orderBy(["nombre" => SORT_ASC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                $arrayResp[$key]['usuariocreacion'] =  $data->usuariocreacion0->username;
                if ($id == "id") {
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/verbanco?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/actualizarbanco?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "descripcion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }

        return json_encode($arrayResp);
    }

    /**

     * Displays a single QuinielaHead model.

     * @param integer $id

     * @return mixed

     */

    public function actionVerdescarga($id)

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        return $this->render('verdescarga', [
            'model' => $this->findModel($id),

        ]);

    }
    /**

     * Creates a new QuinielaHead model.

     * If creation is successful, the browser will be redirected to the 'view' page.

     * @return mixed

     */
    private function subirArchivo($imagen)
    {
        //$target_dir = '/xampp-new/htdocs/cpn2/frontend/web/pdf/';
        $target_dir = '/var/www/html/frontend/web/pdf/';
        $target_file = $target_dir . basename($imagen["name"]);
        $nombreArchivo=basename($imagen["name"]);
        $uploadOk = 1;
        $imageFileType = $imagen['type'];
        // Check if image file is a actual image or fake image
           /*  $check = getimagesize($imagen["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $return=array("success"=>false,"Mensaje"=>"El archivo no es una imagen.");
                $uploadOk = 0;
            } */
        // Check if file already exists
        if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
            $return=array("success"=>false,"Mensaje"=>"La imagen ya existe en el repositorio.");
            $uploadOk = 0;
        }
        // Check file size
        if ($imagen["size"] > 5000000) {
            $return=array("success"=>false,"Mensaje"=>"El archivo subida excede el límite de tamaño. Tamaño: ".$imagen["size"]);
            //echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "application/vnd.ms-excel" && $imageFileType != "application/pdf" && $imageFileType != "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
        && $imageFileType != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) {
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $return=array("success"=>false,"Mensaje"=>"El archivo debe se un archivo permitido. Tipo: ".$imageFileType);
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $return=array("success"=>false,"Mensaje"=>$return["Mensaje"]);
            //echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            //echo move_uploaded_file($imagen["tmp_name"], $target_file);
            if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
                $return=array("success"=>true,"Mensaje"=>"Archivo subido.","Nombrearchivo"=>$nombreArchivo);
                //$return=array("success"=>"true","Mensaje"=>"OK");
                //echo json_encode($return);
                //echo "The file ". basename( $imagen["name"]). " has been uploaded.";
            } else {
                $return=array("success"=>false,"Mensaje"=>"La imagen no se ha podido guardar.");
            }
        }
        return $return;
    }

    public function actionNuevadescarga()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        $flagHeader = false;
        $flagDetail = false;
        $pagina = Paginas::find()->where(['isDeleted' => '0'])->all();
        $model = new Descargables();
        if (isset($_POST) and !empty($_POST)) {
            $uploadFile= $this->subirArchivo($_FILES["imagen"]);
            //die(var_dump($uploadFile));
            if ($uploadFile["success"])
            {
                //echo 'OK';
                $data = $_POST;
                //Model header

                $model->nombre = $data['nombre'];
                $model->archivo = $uploadFile["Nombrearchivo"];
                $model->pagina = $data['tipo'];
                $model->vista = $data['vista'];
                $model->superior = $data['superior'];
                $model->isDeleted = 0;
                $model->orden =  $data['orden'];
                $model->estatus =  $data['estado'];
                $saveModel=$model->save();
                //var_dump($_POST);
                $flagHeader = true;
                if ($saveModel) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar ela descarga.","resp" => false, "id" => "");
                }
                //var_dump($model->errors);
            }else{
                $return=array("success"=>false,"Mensaje"=>$uploadFile["Mensaje"],"resp" => false, "id" => "");
            }

            echo json_encode($return);
        } else {
            return $this->render('nuevadescarga', [
                'model' => $model,
                'pagina' => $pagina,
            ]);
            return $this->render('nuevadescarga');
        }
    }



    /**

     * Updates an existing QuinielaHead model.

     * If update is successful, the browser will be redirected to the 'view' page.

     * @param integer $id

     * @return mixed

     */

    public function actionUpdate($id)

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $model = new Slider();
        if (isset($_POST) and !empty($_POST)) {
            $model = $this->findModel($id);
            //$uploadFile= $this->subirImagen($_FILES["imagen"]);
            //$uploadFileM= $this->subirImagen($_FILES["imagenmobile"]);
            //die(var_dump($uploadFile));
            //if ($uploadFile["success"] && $uploadFileM["success"])
            //{
                //echo 'OK';
            $data = $_POST;
            //Model header
            $model->titulo = $data['nombre'];
            $model->descripcion = $data['descripcion'];
            $model->link = $data['enlace'];
            //$model->image = $uploadFile["Nombrearchivo"];
            //$model->imageresponsive = $uploadFileM["Nombrearchivo"];
            //$model->isDeleted = 0;
            $model->orden =  $data['orden'];
            $model->estatus =  $data['estado'];
            $saveModel=$model->save();
            //var_dump($_POST);
            $flagHeader = true;
            if ($saveModel) {
                $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
            }else{
                $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el banner.","resp" => false, "id" => "");
            }
            //}else{
            //    $return=array("success"=>false,"Mensaje"=>"Error al subir la imagen, verifique que la imagen no exista.","resp" => false, "id" => "");
            //}

            echo json_encode($return);
        } else {
            $model = $this->findModel($id);
            $flagDetail = false;
            $modelDetail = array();

            return $this->render('update', [
                'flagDetail' => $flagDetail,
                'model' => $model,
                'modelDetail' => $modelDetail,
            ]);
        }
    }

    /**
     * Deletes an existing QuinielaHead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionDelete($id)

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $model = $this->findModel($id);
        $model->isDeleted = 1;
        if ($model->save())
        {
            return $this->redirect(['index']);
        }else{
            var_dump($model->errors);
        }
    }

    /**
     * Finds the QuinielaHead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuinielaHead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Descargables::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
