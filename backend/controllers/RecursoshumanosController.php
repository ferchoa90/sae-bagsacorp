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

use common\models\Presentacion;

use common\models\Productos;

use common\models\Empleados;

use common\models\Departamentos;

use common\models\Marcaciones;

use backend\models\User;



class RecursoshumanosController extends Controller

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

    public function actionDepartamentos()
    {
        return $this->render('departamentos');
    }

    public function actionVerempleado($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $empleado= Empleados::find()->where(['id' => $id])->one();
        return $this->render('verempleado', [
            'model' => $empleado,

        ]);
    }


    public function actionNuevoempleado()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $departamento = Departamentos::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_ASC])->all();

        $flagHeader = false;
        $flagDetail = false;

        if (isset($_POST) and !empty($_POST)) {
            $data = $_POST;


            //Model header
            $model = new Empleados();
            $model->cedula='9999999999';
            $model->nombres=$data['nombres'];
            $model->apellidos=$data['apellidos'];
            $model->correo=$data['correo'];
            $model->idbiometrico=$data['idbio'];
            $model->id=$data['idbio'];
            $model->fechaingreso='2021-07-05';
            $model->direccion="";
            $model->telefono="";
            $model->tiposangre="";
            $model->nacionalidad="ECUADOR";
            $model->contactoemer="";
            $model->telefonoemer="";
            $model->iddepartamento=$data['departamento'];
            $model->fechasalida="";
            $model->usuariocreacion=Yii::$app->user->identity->id;
            $model->estatus=$data['estado'];
            $model->isDeleted=0;


            if ($model->save()) {
                echo json_encode(array("resp" => true, "id" => $model->id, "Mensaje"=> "Empleado agregado correctamente","success"=>true));
            } else {
                echo json_encode(array("resp" => false, "id" => "", "Mensaje" =>"Hubo un error al agregar el empleado","success"=>false,"Error"=>$model->errors,"data"=>$data));
            }

        } else {
            return $this->render('nuevoempleado', [
                'departamento' => $departamento,
            ]);
        }

    }

    public function actionEmpleados()
    {
        return $this->render('empleados');
    }

    public function actionMarcajes()
    {
        return $this->render('marcajes');
    }

    public function actionVerdepartamento($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        return $this->render('verdepartamento', [
            'model' =>  Departamentos::find()->where(['id'=>$id])->one()
        ]);
    }

    public function actionNuevodepartamento()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        $model = new Departamentos();
        $marca = Departamentos::find()->where(['isDeleted'=>0])->all();
        if (isset($_POST) and !empty($_POST)) {
                $data = $_POST;
                //Model header
                $model = new Departamentos();
                $model->nombre = $data['nombre'];
                $model->usuariocreacion = Yii::$app->user->identity->id;
                $model->isDeleted = 0;
                $model->estatus =  $data['estado'];
                $saveModel=$model->save();
                //var_dump($_POST);
                $flagHeader = true;
                if ($saveModel) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el departamento.","resp" => false, "id" => "");
                }
            return json_encode($return);
        } else {
            return $this->render('nuevodepartamento', [
                'model' => $model,
            ]);
        }
    }

    public function actionEmpleadosregistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "empleados";
        $model = Empleados::find()->where(['isDeleted' => '0'])->orderBy(["apellidos" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $arrayResp[$key]['departamento'] = $data->iddepartamento0->nombre;
                if ($id == "id") {
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/verdescarga?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="fas fa-eye"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/actualizardescarga?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="fas fa-pencil-alt"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="fas fa-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "cedula") || ($id == "apellidos") || ($id == "nombres") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechaingreso") || ($id == "direccion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "telefono") || ($id == "tiposangre") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "idbiometrico")  ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "nacionalidad") || ($id == "fechasalida") ) { $arrayResp[$key][$id] = $text; }

                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }


    public function actionDepartamentosregistros()

    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $page = "recursoshumanos";

        $model = Departamentos::find()->where(['isDeleted' => '0'])->orderBy(["nombre" => SORT_DESC])->all();

        $arrayResp = array();

        $count = 0;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {

                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $arrayResp[$key]['empresa'] = "BAGSACORP";
                if ($id == "id") {
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/verdepartamento?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="fas fa-eye"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/editardepartamento?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="fas fa-pencil-alt"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="fas fa-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre")) { $arrayResp[$key][$id] = $text; }

                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }


    public function actionMarcajesregistros()

    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $page = "marcajes";

        $model = Marcaciones::find()->orderBy(["fechacreacion" => SORT_DESC])->all();

        $arrayResp = array();

        $count = 0;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {

                $arrayResp[$key]['num'] = $count+1;
                //$arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                //$arrayResp[$key]['empresa'] = "N/A";
                $arrayResp[$key]['empleado'] = $data->iduser0->apellidos.' '.$data->iduser0->nombres;

                if (($id == "fechahora")) { $arrayResp[$key][$id] = $text; }
                if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }

            }
            $count++;
        }
        return json_encode($arrayResp);
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





    /**

     * Finds the QuinielaHead model based on its primary key value.

     * If the model is not found, a 404 HTTP exception will be thrown.

     * @param integer $id

     * @return QuinielaHead the loaded model

     * @throws NotFoundHttpException if the model cannot be found

     */

    protected function findModel($id)

    {

        if (($model = Inventario::findOne($id)) !== null) {

            return $model;

        } else {

            throw new NotFoundHttpException('The requested page does not exist.');

        }

    }



}
