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
use common\models\Banco;
use common\models\Caja;
use common\models\Cuentas;
use common\models\Cuentasporcobrar;
use common\models\Cuentasporcobrardet;
use common\models\Cuentasporpagar;
use common\models\Cuentasporpagardet;
use common\models\Cuentasparametros;
use common\models\Periodofiscal;
use common\models\Cuentastipo;
use common\models\Clientes;
use common\models\Diario;
use common\models\Diariodetalle;
use common\models\Retenciones;
use common\models\Retencioncxc;
use common\models\Formapagocuentas;
use backend\components\Botones;
use kartik\mpdf\Pdf;


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

    public function actionRetenciones()
    {
        return $this->render('retenciones');
    }

    public function actionRetencionescxc()
    {
        return $this->render('retencionescxc');
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

    public function actionBancosmov()
    {
        return $this->render('bancosmov');
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

    public function actionCaja()
    {
        return $this->render('caja');
    }

    public function actionAsientos()
    {
        return $this->render('asiento');
    }

    public function actionPdfasiento($id)
    {
        date_default_timezone_set('America/Guayaquil');
        $asiento= Diario::find()->where(['id' => $id, "isDeleted" => 0])->one();
        $asientodetalle=Diariodetalle::find()->where(['diario' => $asiento->diario, "isDeleted" => 0])->all();
        $content = $this->renderPartial('pdfasiento', [
            'asiento' =>$asiento,
            'asientodetalle' => $asientodetalle,
        ]);
        //$fecha=date('d-m-Y');
        $fecha=date('d-m-Y H:i:s');
    // setup kartik\mpdf\Pdf component
    $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_BLANK,
        // A4 paper format
        'format' => Pdf::FORMAT_A4,
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT,
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER,
        // your html content input

        'content' => $content,
        // format content from your own css file if needed or use the
        // enhanced bootstrap css built by Krajee for mPDF formatting
        //'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
        'cssFile' => '@backend/web/css/sitepdf.css',
        // any css to be embedded if required
        //'cssInline' => '.kv-heading-1{font-size:18px}',
         // set mPDF properties on the fly
        'options' => ['title' => 'Sistema SAE Empresarial'],
         // call mPDF methods on the fly
        'methods' => [
            'SetHeader'=>["SISTEMA SAE ($fecha)"],
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
    //$pdf->SetHTMLHeader('<img src="' .'/custom/Hederinvoice.jpg"/>');
    // return the pdf output as per the destination setting
    return $pdf->render();
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
        $bancos= Banco::find()->where(['id' => $id, "isDeleted" => 0])->one();
        //var_dump($bancos);
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

    public function actionVercuentapp($id)
    {
        $cuenta= Cuentasporpagar::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('vercuentapp', [
            'cuenta' =>$cuenta,
            'cuentadetalle' => Cuentasporpagardet::find()->where(['numero' => $cuenta->id, "isDeleted" => 0])->all(),
        ]);

    }

    public function actionVerretencion($id)
    {
        $retencion= Retenciones::find()->where(['id' => $id, "isDeleted" => 0])->one();
        $retenciondetalle= Retenciones::find()->where(['numero' => $retencion->numero, "isDeleted" => 0])->all();

        return $this->render('verretencion', [
            'retencion' =>$retencion,
            'retenciondetalle' =>$retenciondetalle,
        ]);

    }

    public function actionVercaja($id)
    {
        $caja= Caja::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('vercaja', [
            'caja' =>$caja,
            //'rolpermisos' => Rolespermisos::find()->where(['idrol' => $rol->id])->all(),
        ]);

    }

    public function actionVerretencioncxc($id)
    {
        $retencion= Retencioncxc::find()->where(['id' => $id, "isDeleted" => 0])->one();
        $retenciondetalle= Retencioncxc::find()->where(['numero' => $retencion->numero, "isDeleted" => 0])->all();

        return $this->render('verretencioncxc', [
            'retencion' =>$retencion,
            'retenciondetalle' =>$retenciondetalle,
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

    public function actionCajareg()
    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "caja";
        $view = "caja";
        $model = Caja::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_DESC])->limit(1000)->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $arrayResp[$key]['tipopago'] = $data->tipopagocaja0->nombre;
                $arrayResp[$key]['proveedor'] = $data->proveedor0->nombre;
                //$arrayResp[$key]['departamento'] = $data->iddepartamento0->nombre;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          //array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                      $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
                      //$arrayResp[$key]['acciones'] = '' ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                    //$arrayResp[$key][$id] = '';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                    //$arrayResp[$key][$id] = '';
                } else {
                   //if  ($id == "nombre"){ echo $text;}
                    if (($id == "referencia") || ($id == "fecha") || ($id == "valor")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") || ($id == "concepto")  || ($id == "cuenta")   ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "comprobante") || ($id == "diario")  || ($id == "beneficiario")  ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionBancosmovreg()
    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "caja";
        $model = Banco::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->limit(1000)->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $arrayResp[$key]['tipopago'] = $data->tipopagobanco0->nombre;
                $arrayResp[$key]['proveedor'] = $data->proveedor0->nombre;
                //$arrayResp[$key]['departamento'] = $data->iddepartamento0->nombre;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'verbancos?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarbancos?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                      $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
                      //$arrayResp[$key]['acciones'] = '' ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                    //$arrayResp[$key][$id] = '';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                    //$arrayResp[$key][$id] = '';
                } else {
                   //if  ($id == "nombre"){ echo $text;}
                    if (($id == "referencia") || ($id == "fecha") || ($id == "valor")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") || ($id == "concepto")  || ($id == "cuenta")   ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "comprobante") || ($id == "diario")  || ($id == "beneficiario")  ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
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
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
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
        $model = Diario::find()->where(['isDeleted' => '0'])->orderBy(["anio" => SORT_DESC,"diario" => SORT_DESC])->limit(2000)->all();
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
                         // array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarasiento?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>';
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
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>';
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
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
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
                         // array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarcuentapc?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
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
        $page = "cuentapp";
        $view = "cuentapp";
        $model = Cuentasporpagar::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->limit(2000)->all();
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
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          //array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
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

    public function actionRetencionesreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "retenciones";
        $model = Retenciones::find()->select(["*,sum(baseimponible) as baseimponible,sum(valorretenido) as valorretenido"])->where(['isDeleted' => '0'])->orderBy(["fecha" => SORT_DESC])->groupBy(['numero'])->limit(1000)->all();
        //die(var_dump($model));
        $arrayResp = array();
        $count = 0;
        $view="retencion";
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $arrayResp[$key]['proveedor'] = $data->proveedor0->nombre;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          //array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
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
                   //if  ($id == "nombre"){ echo $text;}
                    if (($id == "comprobante") || ($id == "fecha") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "valorretenido") || ($id == "baseimponible") || ($id == "serie") || ($id == "identificacion")   ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionRetencionescxcreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "retencioncxc";
        $model = Retencioncxc::find()->select(["*,sum(baseimponible) as baseimponible,sum(valorretenido) as valorretenido"])->where(['isDeleted' => '0'])->orderBy(["fecha" => SORT_DESC])->groupBy(['numero'])->limit(1000)->all();
        //die(var_dump($model));
        $arrayResp = array();
        $count = 0;
        $view="retencioncxc";
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $arrayResp[$key]['cliente'] = $data->cliente0->razonsocial;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          //array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
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
                   //if  ($id == "nombre"){ echo $text;}
                    if (($id == "numero") || ($id == "fecha") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "valorretenido") || ($id == "baseimponible")    ) { $arrayResp[$key][$id] = $text; }
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
                          //array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
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

    protected function findModel($id)
    {
        if (($model = Descargables::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
