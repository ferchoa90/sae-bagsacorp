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
use common\models\Gestioncatering;
use common\models\Horariocomidas;
use common\models\Departamentos;
use common\models\Clientes;
use backend\components\Contabilidad_clientes;
use backend\components\Contabilidad_proveedores;
use backend\models\User;
use kartik\export\ExportMenu;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\data\ArrayDataProvider;

class ReportesController extends Controller

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

    public function actionEstadocliente()
    {
        $clientes= new Contabilidad_clientes;
        $clientes= $clientes->getSelect();
        return $this->render('estadocliente',[
            'clientes'=>$clientes,
        ]);
    }

    public function actionEstadoproveedores()
    {
        $proveedores= new Contabilidad_proveedores;
        $proveedores= $proveedores->getSelect();
        return $this->render('estadoproveedor',[
            'proveedores'=>$proveedores,
        ]);
    }

    public function actionTickets()
    {
        $departamentos = Departamentos::find()->select(['*'])->where("isDeleted = 0")->orderBy(["id" => SORT_ASC])->all();
        $horarios = Horariocomidas::find()->select(['*'])->where("isDeleted = 0")->orderBy(["id" => SORT_ASC])->all();
        //$query = User::find();
        $cookies = Yii::$app->request->cookies;
        if (Yii::$app->request->post())
        {
            //die(var_dump($_POST));
            //$request = Yii::$app->request;
            //$post = $request->post();
            if ($_POST['fechadesde'])
            {
                $fechadesde = substr($_POST['fechadesde'], 6, 4) . '-' . substr($_POST['fechadesde'], 3, 2) . '-' . substr($_POST['fechadesde'], 0, 2);
                $fechahasta = substr($_POST['fechahasta'], 6, 4) . '-' . substr($_POST['fechahasta'], 3, 2) . '-' . substr($_POST['fechahasta'], 0, 2);
                $fechadesdeB=substr($_POST['fechadesde'], 0, 2) . '-' . substr($_POST['fechadesde'], 3, 2) . '-' . substr($_POST['fechadesde'], 6, 4);
                $fechahastaB=substr($_POST['fechahasta'], 0, 2) . '-' . substr($_POST['fechahasta'], 3, 2) . '-' . substr($_POST['fechahasta'], 6, 4);
                setcookie("fechadesde",$fechadesde, time()+3600,"/","saenewcontrol.local");
                setcookie("fechahasta",$fechahasta, time()+3600,"/","saenewcontrol.local");
                setcookie("departamento",$_POST['departamento'], time()+3600,"/","saenewcontrol.local");
                setcookie("servicio",$_POST['servicio'], time()+3600,"/","saenewcontrol.local");

                $_COOKIE["departamento"]=$_POST['departamento'];
                $_COOKIE["servicio"]=$_POST['servicio'];
            }else{
               $fechadesde=$_COOKIE["fechadesde"];
                $fechahasta=$_COOKIE["fechahasta"];

            }

            //echo die(var_dump(substr($_POST['fechadesde'], 0, 2)));
        }else{
            if ($_GET){
             $fechadesde=$_COOKIE["fechadesde"];
             $fechahasta=$_COOKIE["fechahasta"];
             $fechadesdeB=substr($_COOKIE["fechadesde"], 8, 2) . '-' . substr($_COOKIE["fechadesde"], 5, 2) . '-' . substr($_COOKIE["fechadesde"], 0, 4);
             $fechahastaB=substr($_COOKIE["fechahasta"], 8, 2) . '-' . substr($_COOKIE["fechahasta"], 5, 2) . '-' . substr($_COOKIE["fechahasta"], 0, 4);

            }else{
                if (isset($_COOKIE['fechadesde'])){
                    $fechadesde=$_COOKIE["fechadesde"];
                    $fechahasta=$_COOKIE["fechahasta"];
                } else{
                    $fechadesde=date("Y-m-d");
                    $fechahasta=date("Y-m-d");
                    $fechadesdeB=date("d-m-Y");
                    $fechahastaB=date("d-m-Y");
                }
            }
        }
        //$fechadesde="20-07-2021";
        //$fechahasta="20-07-2021";
        //echo $fechadesde;
        $sql = 'SELECT * FROM gestioncatering where fechacreacion="2021/07/17"';
        $query = Gestioncatering::find()->where(['between', 'fechacreacion', $fechadesde." 00:00:00", $fechahasta." 23:59:59" ])->orderBy(["iduser" => SORT_ASC])->all();
        //echo 'S ' .$_COOKIE["servicio"];
        if(@$_COOKIE["servicio"]>0)
        {
           // echo 'S ' .$_COOKIE["servicio"];
            $query = Gestioncatering::find()->where(['between', 'fechacreacion', $fechadesde." 00:00:00", $fechahasta." 23:59:59" ])->andfilterWhere(['idhorarioc' => $_COOKIE["servicio"]])->orderBy(["iduser" => SORT_ASC])->all();
        }
        //die(var_dump($query));

        //$fechahastaB="20-07-2021";
        if(@$_COOKIE["departamento"]>0)
        {
            foreach ($query as $key => $value) {      // Recorrer los elementos del array
                //echo ($value->iduser0->iddepartamento0->id).'; ';
                if (($value->iduser0->iddepartamento0->id!=$_COOKIE["departamento"])) {                 // Si la clave es un entero:
                    unset($query[$key]);              // Destruir la variable (elemento del array)
                }
            }
        }


        //die(var_dump($_SESSION["fechadesde"]));
        $dataProvider = new ArrayDataProvider([
            'pagination' => ['pageSize' =>500],
            'allModels' => $query
        ]);

        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],

            [

                'attribute' => 'nombreempleado',
                'label' => 'Nombre Empleado',
                'value' => 'nombreempleado'
            ],
            [
                'attribute' => 'nombreempresa',
                'label' => 'Empresa',
                'value' => 'nombreempresa'
            ],
            [
                'attribute' => 'nombretiposer',
                'label' => 'Servicio',
                'value' => 'nombretiposer'
            ],
            'fechacreacion',
           // ['class' => 'yii\grid\ActionColumn'],
        ];
        // Renders a export dropdown menu
        $exportmenu= ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'exportConfig' => [
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_TEXT => true,
            ],
            'dropdownOptions' => [
                'label' => 'Export All',
                'class' => 'btn btn-outline-secondary'
            ],
            'filename' => 'exportado-data_' . date('Y-m-d_H-i-s'),
        ]);

        // You can choose to render your own GridView separately
        $gridview= \kartik\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns
        ]);
//echo $fechadesdeB;
        return $this->render('tickets', [
            //'flagDetail' => $flagDetail,
            'exportmenu' => $exportmenu,
            'gridview' => $gridview,
            'fechadesde' => $fechadesdeB,
            'fechahasta' => $fechahastaB,
            'departamentos' => $departamentos,
            'horarios' => $horarios,
            //'modelDetail' => $modelDetail,
        ]);

    }

    public function actionReimpresion()
    {
        return $this->render('reimpresion');
    }

    public function actionVentasdiarias()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "reportes";

        $model = Factura::find()
        ->select(['DAY(fechacreacion) AS fechacreacion,SUM(total) AS total,MONTH(fechacreacion) AS nfactura,YEAR(fechacreacion) AS idcliente'])
        ->where("estatus = 'ACTIVA'")
        ->groupBy(['DAY(fechacreacion)'])
        ->all();

        //var_dump($model);
        //$model = Productos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($model as $key => $data) {
                    $arrayResp[$key]["mes"] = $data->nfactura;
                    $arrayResp[$key]["anio"] = $data->idcliente;
                    $arrayResp[$key]["fecha"] = $data->fechacreacion;
                    $arrayResp[$key]["total"] = $data->total;
        }
        return json_encode($arrayResp);
    }

    public function actionReimpresionregistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "empleados";
        $model = Gestioncatering::find()->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['ticket'] = $data->id;
                $arrayResp[$key]['usuariocreacion'] = "Dispositivo";
                $arrayResp[$key]['empleado'] = $data->iduser0->apellidos.' '.$data->iduser0->nombres;
                $arrayResp[$key]['departamento'] = $data->iduser0->iddepartamento0->nombre;
                $arrayResp[$key]['fechahora'] = $data->idmarcacion0->fechahora;
                $arrayResp[$key]['tiposervicio'] = $data->idhorarioc0->nombre;
                if ($id == "id") {
                    $arrayResp[$key]['button'] = '&nbsp;<button type="submit" alt="Reimprimir" title="Reimprimir" data-id="' . $text . '" data-name="' . $id . '" onclick="printReg('.$text.')" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-print"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {



                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }


    public function actionTicketreimpresion($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $this->layout = 'impresion';
        $gestion = Gestioncatering::find()->where(['id' => $id])->one();
        return $this->render('ticketreimpresion', [
            'gestion' => $gestion,
        ]);
    }

    public function actionEstadoclientefilter(){
        extract($_POST);
        $result= array();
        $arrayResp = array();
        $count = 0;
        $factura= Factura::find()->where(['idcliente' => $cliente,'estatus'=>'ACTIVO'])->andWhere(['between', 'fecha', $desde, $hasta ])->all();
        $anio=substr($desde,0,4);
        $cont=0;
        $valort=0; $abonot=0; $saldot=0;
        foreach ($factura as $key => $value) {
            //echo $value->diario;
            $diarioneto=str_replace($anio.'-',"",$value->diario);
            $diario= Diario::find()->where(['diario' => $diarioneto, 'anio'=>$anio])->one();
            $cuentaxc= Cuentasporcobrar::find()->where(['diario' => $value->diario])->one();
            $retencionescxc= Retencioncxc::find()->where(['facturanum' => $value->nfactura])->all();

            //var_dump($cuentaxc);

            $arrayResp[$cont]["numerofactura"]=$value->nfactura;

            $arrayResp[$cont]["fecha"]=$value->fecha;
            $arrayResp[$cont]["costo"]=$value->costo;
            $arrayResp[$cont]["iva"]=$value->iva;
            $arrayResp[$cont]["descuento"]=$value->descuento;
            $arrayResp[$cont]["vencimiento"]=$value->vencimiento;
            $arrayResp[$cont]["dias"]=$value->diasplazo;

            if ($cuentaxc){
                $arrayResp[$cont]["concepto"]=$cuentaxc->concepto;
                $arrayResp[$cont]["abono"]="";
                $arrayResp[$cont]["valor"]=$cuentaxc->valor;
                $arrayResp[$cont]["saldo"]="";
                $arrayResp[$cont]["movimiento"]=$cuentaxc->id;
                $valort+=$cuentaxc->valor;

                $arrayResp[$cont]["abonot"]=number_format($abonot,2);
                $arrayResp[$cont]["valort"]=number_format($valort,2);
                $arrayResp[$cont]["saldot"]=number_format($valort-$abonot,2);
            }else{
                $arrayResp[$cont]["concepto"]="";
                $arrayResp[$cont]["abono"]="";
                $arrayResp[$cont]["valor"]="";
                $arrayResp[$cont]["saldo"]="";
                $arrayResp[$cont]["vencimiento"]="";
                $arrayResp[$cont]["dias"]="";
                $arrayResp[$cont]["abonot"]=number_format($abonot,2);
                $arrayResp[$cont]["valort"]=number_format($valort,2);
                $arrayResp[$cont]["saldot"]=number_format($valort-$abonot,2);
            }
            if ($diario){
                $arrayResp[$cont]["tipoaux"]=$diario->tipoaux;
            }else{
                $arrayResp[$cont]["tipoaux"]="";
            }
            $arrayResp[$cont]["diario"]=$value->diario;
            $cuentaxcret= Cuentasporcobrar::find()->where(['idfactura' => $value->nfactura])->one();
            $cont++;
            if ($retencionescxc){
                $ncomprobante;$fecha;$valor=0;$costo=0;$abono=0;$concepto;$origen=0;
                foreach ($retencionescxc as $keyR => $valueR) {
                    $ncomprobante=$valueR->numero;
                    $fecha=$valueR->fecha;
                    $valor+=$valueR->valorretenido;
                    $abono+=($valueR->baseimponible-$valueR->valorretenido);
                    $origen=$valueR->origen;
                }

                $arrayResp[$cont]["numerofactura"]=$ncomprobante;
                $arrayResp[$cont]["movimiento"]=$origen;
                $arrayResp[$cont]["fecha"]=$fecha;
                $arrayResp[$cont]["valor"]="";
                $arrayResp[$cont]["abono"]=$valor;
                $arrayResp[$cont]["saldo"]=$abono;



                $arrayResp[$cont]["tipoaux"]="RET";
                $arrayResp[$cont]["descuento"]="";
                $arrayResp[$cont]["vencimiento"]="";
                $arrayResp[$cont]["dias"]="";
                $arrayResp[$cont]["diario"]="";
                //$arrayResp[$cont]["concepto"]="COM RET".substr(0,12,$ncomprobante)." FACT ".$value->nfactura;
                $arrayResp[$cont]["concepto"]=$cuentaxcret->concepto;

                $abonot+=$valor;
                $saldot+=$abono;

                $arrayResp[$cont]["abonot"]=number_format($abonot,2);
                $arrayResp[$cont]["valort"]=number_format($valort,2);
                $arrayResp[$cont]["saldot"]=number_format($valort-$abonot,2);

                $cont++;
            }
            $cuentaxcpag= Cuentasporcobrardet::find()->where(['numerofactura' => $cuentaxc->id])->all();
            //$cuentaxcpag= $cuentaxcret->cuentaxcdet;
            //var_dump($cuentaxcpag);
            if ($cuentaxcpag)
            {
                //echo $ncomprobante;
                foreach ($cuentaxcpag as $keyCP => $valueCP) {
                   // echo '--- ';
                   // echo $valueCP->numero.' | ';
                   // echo ' | '.$origen.' | ';

                        // echo 'ORIGN:'.$valueCP->numero;
                        $banco=Banco::find()->where(['cartera' => $valueCP->numero])->one();
                        if ($banco){
                            $arrayResp[$cont]["numerofactura"]="";
                            $arrayResp[$cont]["movimiento"]=$valueCP->numero;
                            $arrayResp[$cont]["fecha"]=$valueCP->fecha;
                            $arrayResp[$cont]["valor"]="";
                            $arrayResp[$cont]["abono"]=$valueCP->valor;
                            $arrayResp[$cont]["saldo"]=number_format($abono-$valueCP->valor,2);

                            $arrayResp[$cont]["tipoaux"]="TRA";
                            $arrayResp[$cont]["descuento"]="";
                            $arrayResp[$cont]["vencimiento"]="";
                            $arrayResp[$cont]["dias"]="";
                            $arrayResp[$cont]["diario"]="";
                            //$arrayResp[$cont]["concepto"]="COM RET".substr(0,12,$ncomprobante)." FACT ".$value->nfactura;
                            $arrayResp[$cont]["concepto"]=$banco->concepto;
                            $abonot+=$valueCP->valor;
                            $saldot+=($abono-$valueCP->valor);

                            $arrayResp[$cont]["abonot"]=number_format($abonot,2);
                            $arrayResp[$cont]["valort"]=number_format($valort,2);
                            $arrayResp[$cont]["saldot"]=number_format($valort-$abonot,2);
                        }


                }
                $cont++;
            }
        }
        return json_encode($arrayResp);
    }

    public function actionEstadoproveedoresfilter(){
        extract($_POST);
        $result= array();
        $arrayResp = array();
        $count = 0;
        $cuentapp= Cuentasporpagar::find()->where(['idproveedor' => $proveedores,'estatus'=>'ACTIVO', "tipo"=>"D"])->andWhere(['between', 'fecha', $desde, $hasta ])->all();
        $anio=substr($desde,0,4);
        $cont=0;
        $valort=0; $abonot=0; $saldot=0;
        //var_dump($cuentapp);

        foreach ($cuentapp as $key => $value) {
            //echo $value->diario;
            $diarioneto=str_replace($anio.'-',"",$value->diario);
            $diario= Diario::find()->where(['diario' => $diarioneto, 'anio'=>$anio])->one();
            $cuentaxc= Cuentasporpagardet::find()->where(['numerofactura' => $value->id])->all();


            //var_dump($cuentaxc);

            $arrayResp[$cont]["numerofactura"]=$value->referencia;

            $arrayResp[$cont]["fecha"]=$value->fecha;
            $arrayResp[$cont]["costo"]="";
            $arrayResp[$cont]["tipoaux"]="FAC";
            $arrayResp[$cont]["iva"]=$value->valoriva;
            $arrayResp[$cont]["descuento"]="";
            $arrayResp[$cont]["vencimiento"]=$value->vencimiento;
            $arrayResp[$cont]["dias"]=$value->dias;
            $arrayResp[$cont]["concepto"]=$value->concepto;
            $arrayResp[$cont]["abono"]="";
            $arrayResp[$cont]["valor"]=$value->valor;
            $arrayResp[$cont]["saldo"]="";
            $arrayResp[$cont]["movimiento"]=$value->id;
            $valort+=$value->valor;
            $arrayResp[$cont]["abonot"]=number_format($abonot,2);
            $arrayResp[$cont]["valort"]=number_format($valort,2);
            $arrayResp[$cont]["saldot"]=number_format($valort-$abonot,2);
            $saldo=$value->valor;
            if ($cuentaxc){
                foreach ($cuentaxc as $key => $valueCXP) {
                    $cont++;
                    $arrayResp[$cont]["vencimiento"]=$value->fecha;
                    $banco=Banco::find()->where(['antimovimiento' => $valueCXP->numero])->one();
                    if ($banco){
                        $arrayResp[$cont]["concepto"]=$banco->concepto;
                        $arrayResp[$cont]["numerofactura"]=$banco->referencia;
                        $arrayResp[$cont]["tipoaux"]="CHD";
                        $arrayResp[$cont]["vencimiento"]=$banco->fecha;
                    }else{
                        $retencionescxc= Retenciones::find()->where(['origen' => $valueCXP->numero])->all();
                        $ncomprobante;$fecha;$valor=0;$costo=0;$abono=0;$concepto;$origen=0;
                        if ($retencionescxc){
                            $diario= Diario::find()->where(['auxiliar' =>$valueCXP->numero])->one();
                            foreach ($retencionescxc as $keyR => $valueR) {
                                $ncomprobante=$valueR->numero;
                                $fecha=$valueR->fecha;
                                $valor+=$valueR->valorretenido;
                                $abono+=($valueR->baseimponible-$valueR->valorretenido);
                                $origen=$valueR->origen;
                            }
                            $arrayResp[$cont]["numerofactura"]=$ncomprobante;
                            $arrayResp[$cont]["concepto"]=$diario->concepto;
                            $arrayResp[$cont]["movimiento"]=$origen;
                            $arrayResp[$cont]["fecha"]=$fecha;
                            $arrayResp[$cont]["vencimiento"]="";
                            $arrayResp[$cont]["valor"]="";
                            $arrayResp[$cont]["abono"]=$valor;
                            $arrayResp[$cont]["saldo"]=$abono;
                            $arrayResp[$cont]["tipoaux"]="RET";

                            $arrayResp[$cont]["abonot"]=number_format($valor,2);
                            $arrayResp[$cont]["valort"]=number_format($valort,2);
                            $arrayResp[$cont]["saldot"]=number_format($abono,2);
                        }

                    }
                    $arrayResp[$cont]["abono"]=number_format($valueCXP->valor,2);
                    $arrayResp[$cont]["iva"]="";
                    $arrayResp[$cont]["fecha"]="";
                    $arrayResp[$cont]["costo"]="";
                    $arrayResp[$cont]["descuento"]="";
                    $arrayResp[$cont]["dias"]="";

                    $arrayResp[$cont]["valor"]="";
                    $arrayResp[$cont]["saldo"]=number_format($saldo-$valueCXP->valor,2);
                    $arrayResp[$cont]["movimiento"]=$valueCXP->numero;
                    //$valort+=$cuentaxc->valor;
                    $abonot+=$valueCXP->valor;
                    $saldo=$saldo-$valueCXP->valor;

                    $arrayResp[$cont]["abonot"]=number_format($abonot,2);
                    $arrayResp[$cont]["valort"]=number_format($valort,2);
                    $arrayResp[$cont]["saldot"]=number_format($valort-$abonot,2);

                }

            }else{
                //$arrayResp[$cont]["concepto"]="";
                $arrayResp[$cont]["abono"]="";
                $arrayResp[$cont]["valor"]="";
                $arrayResp[$cont]["saldo"]="";
                $arrayResp[$cont]["vencimiento"]="";
                $arrayResp[$cont]["dias"]="";
                $arrayResp[$cont]["abonot"]=number_format($abonot,2);
                $arrayResp[$cont]["valort"]=number_format($valort,2);
                $arrayResp[$cont]["saldot"]=number_format($valort-$abonot,2);
            }

            $cont++;


            //$cuentaxcpag= $cuentaxcret->cuentaxcdet;
            //var_dump($cuentaxcpag);

        }
        return json_encode($arrayResp);
    }

}
