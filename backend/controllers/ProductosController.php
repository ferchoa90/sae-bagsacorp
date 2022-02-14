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
use common\models\Marca;
use common\models\Presentacion;
use common\models\Proveedores;
use common\models\Productos;
use common\models\Provincias;
use common\models\Tipoproducto;
use common\models\Tipounidad;
use common\models\Color;
use common\models\Caracteristica;
use common\models\Cuentas;
use backend\components\Contabilidad_cuentas;
use backend\models\User;
use backend\components\Botones;
use backend\components\Modulo_productos;




class ProductosController extends Controller

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

    public function actionProductos()
    {
        return $this->render('productos');
    }



   public function actionInteracciones()

    {

        return $this->render('interacciones');

    }





    public function actionRegistros()

    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $page = "productos";

        $model = Productos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();

        $arrayResp = array();

        $count = 0;

        foreach ($model as $key => $data) {

            foreach ($data as $id => $text) {


                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;

                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';

                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;

                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $arrayResp[$key]['tipop'] = $data->tipoproducto0->nombre;
                $view='producto';
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                         // array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
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
                    if (($id == "nombreproducto") || ($id == "descripcion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "imagen") || ($id == "usuariocreacion")  || ($id == "codigo")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }

                }

            }

            $count++;

        }



        return json_encode($arrayResp);

    }



    public function actionProveedorregistros()

    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $page = "productos";

        $model = Proveedores::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();

        $arrayResp = array();

        $count = 0;

        foreach ($model as $key => $data) {

            foreach ($data as $id => $text) {

                $arrayResp[$key]['num'] = $count;

                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';

                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;

                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;

                if ($id == "id") {

                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/verproducto?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'

                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'

                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'

                        . '<i class="glyphicon glyphicon-trash"></i></button>';

                    //$arrayResp[$key]['button'] = '-';

                }

                if ($id == "estatus" && $text == 'ACTIVO') {

                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';

                } elseif ($id == "estatus" && $text == 'INACTIVO') {

                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';

                } else {

                    if (($id == "nombre")  || ($id == "ruc") ) { $arrayResp[$key][$id] = $text; }

                    if (($id == "contacto") || ($id == "telefono") ) { $arrayResp[$key][$id] = $text; }

                    if (($id == "cargocontacto") || ($id == "descripcion") ) { $arrayResp[$key][$id] = $text; }

                    if (($id == "provincia") || ($id == "ciudad") ) { $arrayResp[$key][$id] = $text; }

                    if (($id == "direccion") || ($id == "correo") ) { $arrayResp[$key][$id] = $text; }

                    if (($id == "persona") || ($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }

                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }

                }

            }

            $count++;

        }



        return json_encode($arrayResp);

    }



    public function actionMarcasregistros()

    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $page = "productos";

        $model = Marca::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();

        $arrayResp = array();

        $count = 0;

        foreach ($model as $key => $data) {

            foreach ($data as $id => $text) {

                $arrayResp[$key]['num'] = $count;

                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';

                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;

                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;

                if ($id == "id") {

                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/verproducto?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'

                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'

                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'

                        . '<i class="glyphicon glyphicon-trash"></i></button>';

                    //$arrayResp[$key]['button'] = '-';

                }

                if ($id == "estatus" && $text == 'ACTIVO') {

                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';

                } elseif ($id == "estatus" && $text == 'INACTIVO') {

                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';

                } else {

                    if (($id == "nombre")  || ($id == "descripcion") ) { $arrayResp[$key][$id] = $text; }

                    if (($id == "persona") || ($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }

                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }

                }

            }

            $count++;

        }
        return json_encode($arrayResp);

    }

    public function actionCategoriasreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "categorias";
        $model = Presentacion::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $view='categorias';
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

                    if (($id == "nombre")  || ($id == "descripcion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "persona") || ($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionPresentacionesreg()

    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $page = "presentacion";

        $model = Presentacion::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();

        $arrayResp = array();

        $count = 0;

        foreach ($model as $key => $data) {

            foreach ($data as $id => $text) {

                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;

                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';

                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;

                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $view='presentacion';
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

                    if (($id == "nombre")  || ($id == "descripcion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "persona") || ($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);

    }

    public function actionTiposreg()

    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $page = "productos";
        $model = Tipoproducto::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {

            foreach ($data as $id => $text) {

                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;

                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';

                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;

                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $view='tipo';
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
                    if (($id == "nombre")  || ($id == "descripcion") || ($id == "cuentainv") || ($id == "cuentaventas") || ($id == "cuentaventasdes") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "persona") || ($id == "usuariocreacion") || ($id == "cuentaventasdev") || ($id == "cuentacostos") || ($id == "cuentacostosdes") || ($id == "cuentacostosdev") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") || ($id == "cuentasalidainv") || ($id == "cuentasalidamue") || ($id == "cuentaentradainv") ) { $arrayResp[$key][$id] = $text; }

                }

            }

            $count++;

        }



        return json_encode($arrayResp);

    }





     public function actionUpdate($id)



    {



        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $return=array();

        $model =  Productos::find()->where(['id'=>$id])->one();

        $marca = Marca::find()->where(['isDeleted'=>0])->orderBy(["nombre" => SORT_ASC])->all();

        $proveedores = Proveedores::find()->where(['isDeleted'=>0])->all();

        $tipoproducto = Tipoproducto::find()->where(['isDeleted'=>0])->all();

        $udfile=false;

        if (isset($_POST) and !empty($_POST)) {

           // die(var_dump($_POST["files"]));

            if (!isset($_POST["files"])){

                $uploadFile= $this->subirImagen($_FILES["imagen"]);

                $udfile=false;

            }else{

                $udfile=true;

                $uploadFile["success"]==true;

            }



            //die(var_dump($uploadFile["success"]));

            if ($uploadFile["success"] || $udfile )

            {

                //echo 'OK';

                $data = $_POST;

                //Model header



                $model->nombreproducto = $data['nombre'];

                $model->descripcion = $data['descripcion'];

                if (!$udfile) {$model->imagen = $uploadFile["Nombrearchivo"];}

                $model->idempresa = 1;

                $model->idproveedor = $data['proveedor'];

                $model->tipoproducto = $data['tipoproducto'];

                $model->marca = $data['marca'];

                $model->usuariocreacion = Yii::$app->user->identity->id;

                $model->modelo = 1;

                $model->color = 0;

                $model->isDeleted = 0;



                $model->estatus =  $data['estado'];

                $saveModel=$model->save();

                //var_dump($_POST);

                $flagHeader = true;

                //var_dump($model->errors);

                if ($saveModel) {

                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);

                }else{

                    //var_dump($model->errors);

                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el producto.","resp" => false, "id" => "");

                }

            }else{

                $return=array("success"=>false,"Mensaje"=>"Error al subir la imagen, Mensaje: ".$uploadFile["Mensaje"],"resp" => false, "id" => "");

            }



            return json_encode($return);

        } else {

            return $this->render('update', [

                'marca' => $marca,

                'proveedores' => $proveedores,

                'tipoproducto' => $tipoproducto,

                'model' => $model,

            ]);

        }

    }
    /**
     * Displays a single QuinielaHead model.
     * @param integer $id
     * @return mixed
     */

    public function actionVerproducto($id)
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        return $this->render('verproducto', [
            'producto' => Productos::find()->where(['id'=>$id])->one(),
            //'modelTeam' => Productos::find()->all(),
        ]);
    }



    public function actionVertipo($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $tipoproducto= Tipoproducto::find()->where(['id'=>$id])->one();
        //$cuentaID=New Contabilidad_cuentas;
        // die(var_Dump($tipoproducto["id"]));
        //$cuentaID= $cuentaID->getCuenta($tipoproducto["id"]);
        return $this->render('vertipo', [
            'model' =>  $tipoproducto,
           // 'cuentas' =>  $cuentas,
        ]);
    }

    public function actionEditartipo($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $cuentasArray=array();
        $cuentas=Cuentas::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["codigoant" => SORT_ASC])->all();
        $cont=0;
        foreach ($cuentas as $key => $value) {
            if ($cont==0){ $cuentasArray[$cont]["value"]="Seleccione una cuenta"; $bancosArray[$cont]["id"]=-1; $cont++; }
            $cuentasArray[$cont]["value"]=$value->codigoant. ' ('.$value->nombre.')';
            $cuentasArray[$cont]["id"]=$value->codigoant;
            $cont++;
        }


        return $this->render('editartipo', [
            'model' =>  Tipoproducto::find()->where(['id'=>$id])->one(),
            'cuentas' =>  $cuentasArray,
        ]);
    }

    public function actionVermarca($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        return $this->render('vermarca', [
            'model' =>  Marca::find()->where(['id'=>$id])->one()

        ]);
    }



    public function actionVerpresentacion($id)
    {
        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");
        }


        return $this->render('verpresentacion', [
            'model' =>  Presentacion::find()->where(['id'=>$id])->one()

        ]);

    }


    public function actionVerproveedor($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        return $this->render('verproveedor', [
            'model' =>  Proveedores::find()->where(['id'=>$id])->one()
        ]);

    }


    private function subirImagen($imagen)

    {

        //$target_dir = '/xampp/htdocs/saenew/frontend/web/images/articulos/';
        $target_dir = '/home/agtecnologyec/public_html/facturacion/frontend/web/images/articulos/';
        $tmpdir=date("YmdHis");
        $imagen["name"]=$tmpdir.'-'.$imagen["name"];
        $target_file = $target_dir . basename($imagen["name"]);
        $nombreArchivo=basename($imagen["name"]);
        $uploadOk = 0;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image

            $check = getimagesize($imagen["tmp_name"]);

            if($check !== false) {

                //echo "File is an image - " . $check["mime"] . ".";

                $uploadOk = 1;

            } else {

                //echo "File is not an image.";

                $return=array("success"=>false,"Mensaje"=>"El archivo no es una imagen.");

                $uploadOk = 0;

            }

        // Check if file already exists

        if (file_exists($target_file)) {

            //echo "Sorry, file already exists.";

            $return=array("success"=>false,"Mensaje"=>"La imagen ya existe en el repositorio.");

            $uploadOk = 0;

        }

        // Check file size

        if ($imagen["size"] > 5000000) {

            $return=array("success"=>false,"Mensaje"=>"La imagen subida excede el límite de tamaño.");

            //echo "Sorry, your file is too large.";

            $uploadOk = 0;

        }

        // Allow certain file formats

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"

        && $imageFileType != "gif" ) {

            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

            $return=array("success"=>false,"Mensaje"=>"El archivo debe se una imagen válida.");

            $uploadOk = 0;

        }

        // Check if $uploadOk is set to 0 by an error

        if ($uploadOk == 0) {

            $return=array("success"=>false,"Mensaje"=> $return["Mensaje"]);

            //echo "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file

        } else {

            //echo move_uploaded_file($imagen["tmp_name"], $target_file);

            if (move_uploaded_file($imagen["tmp_name"], $target_file)) {

                $return=array("success"=>true,"Mensaje"=>"Imagen subida.","Nombrearchivo"=>$nombreArchivo);

                //$return=array("success"=>"true","Mensaje"=>"OK");

                //echo json_encode($return);

                //echo "The file ". basename( $imagen["name"]). " has been uploaded.";

            } else {

                $return=array("success"=>false,"Mensaje"=>"La imagen no se ha podido guardar.");

            }

        }

        return $return;

    }



    public function actionNuevo()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        $proveedores = Proveedores::find()->where(['isDeleted'=>0])->all();
        
        $lineasArray=array();$unidadArray=array();$caracteristicaArray=array();$marcaArray=array();$colorArray=array();
        $lineas=Tipoproducto::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["id" => SORT_ASC])->all();
        $unidad=Tipounidad::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["id" => SORT_ASC])->all();
        $marca=Marca::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["nombre" => SORT_ASC])->all();
        $color=Color::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["id" => SORT_ASC])->all();
        $caracteristica=Caracteristica::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["id" => SORT_ASC])->all();
        $cont=0;
        //die(var_dump($lineas));
        foreach ($lineas as $key => $value) {
            if ($cont==0){ $lineasArray[$cont]["value"]="Seleccione un tipo"; $lineasArray[$cont]["id"]=-1; $cont++; }
            $lineasArray[$cont]["value"]=$value->nombre;
            $lineasArray[$cont]["id"]=$value->id;
            $cont++;
        }
        $cont=0;
        foreach ($unidad as $key => $value) {
            if ($cont==0){ $unidadArray[$cont]["value"]="Seleccione una unidad"; $unidadArray[$cont]["id"]=-1; $cont++; }
            $unidadArray[$cont]["value"]=$value->nombre;
            $unidadArray[$cont]["id"]=$value->id;
            $cont++;
        }

        $cont=0;
        foreach ($caracteristica as $key => $value) {
            if ($cont==0){ $caracteristicaArray[$cont]["value"]="Seleccione una caracteristica"; $caracteristicaArray[$cont]["id"]=-1; $cont++; }
            $caracteristicaArray[$cont]["value"]=$value->nombre;
            $caracteristicaArray[$cont]["id"]=$value->id;
            $cont++;
        }

        $cont=0;
        foreach ($marca as $key => $value) {
            if ($cont==0){ $marcaArray[$cont]["value"]="Seleccione una marca"; $marcaArray[$cont]["id"]=-1; $cont++; }
            $marcaArray[$cont]["value"]=$value->nombre;
            $marcaArray[$cont]["id"]=$value->id;
            $cont++;
        }

        $cont=0;
        foreach ($color as $key => $value) {
            if ($cont==0){ $colorArray[$cont]["value"]="Seleccione un color"; $colorArray[$cont]["id"]=-1; $cont++; }
            $colorArray[$cont]["value"]=$value->nombre;
            $colorArray[$cont]["id"]=$value->id;
            $cont++;
        }


        return $this->render('nuevo', [
            'marca' => $marcaArray,
            'color' => $colorArray,
            'proveedores' => $proveedores,
            'caracteristica' => $caracteristicaArray,
            'lineas' => $lineasArray,
            'tipounidad' => $unidadArray,
            'model' => $model, 
        ]);
        
    }

    public function actionFormproducto()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        $productos= new Modulo_productos;
        $productos= $productos->Nuevo($_POST);
        //die(var_dump($_POST));
        $response=$productos;

        //return $this->render('formrol');
        return json_encode($response);

    }

    public function actionMarcanueva()

    {

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $return=array();

        $model = new Marca();

        $marca = Marca::find()->where(['isDeleted'=>0])->all();

        if (isset($_POST) and !empty($_POST)) {



                //echo 'OK';

                $data = $_POST;

                //Model header

                $model = new Marca();

                $model->nombre = $data['nombre'];

                $model->descripcion = $data['descripcion'].'.';

                $model->usuariocreacion = Yii::$app->user->identity->id;

                $model->isDeleted = 0;

                $model->estatus =  $data['estado'];

                $saveModel=$model->save();

                //var_dump($_POST);



                $flagHeader = true;

                if ($saveModel) {

                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);

                }else{

                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el producto.","resp" => false, "id" => "");

                }

            return json_encode($return);

        } else {

            return $this->render('marcanueva', [

                'model' => $model,

            ]);

        }

    }



    public function actionPresentacionnueva()

    {

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $return=array();

        $model = new Presentacion();

        $marca = Presentacion::find()->where(['isDeleted'=>0])->all();

        if (isset($_POST) and !empty($_POST)) {



                //echo 'OK';

                $data = $_POST;

                //Model header

                $model = new Presentacion();

                $model->nombre = $data['nombre'];

                $model->descripcion = $data['descripcion'].'.';

                $model->usuariocreacion = Yii::$app->user->identity->id;

                $model->isDeleted = 0;

                $model->estatus =  $data['estado'];

                $saveModel=$model->save();

                //var_dump($_POST);

                $flagHeader = true;

                if ($saveModel) {

                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);

                }else{

                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el producto.","resp" => false, "id" => "");

                }

            return json_encode($return);

        } else {

            return $this->render('presentacionnueva', [

                'model' => $model,

            ]);

        }

    }



    public function actionTiposnuevo()

    {

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $return=array();

        $model = new Tipoproducto();

        $marca = Tipoproducto::find()->where(['isDeleted'=>0])->all();

        if (isset($_POST) and !empty($_POST)) {



                //echo 'OK';

                $data = $_POST;

                //Model header

                $model = new Tipoproducto();

                $model->nombre = $data['nombre'];

                $model->descripcion = $data['descripcion'].'.';

                $model->usuariocreacion = Yii::$app->user->identity->id;

                $model->isDeleted = 0;

                $model->estatus =  $data['estado'];

                $saveModel=$model->save();

                //var_dump($_POST);

                $flagHeader = true;

                if ($saveModel) {

                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);

                }else{

                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el producto.","resp" => false, "id" => "");

                }

            return json_encode($return);

        } else {

            return $this->render('tiposnuevo', [

                'model' => $model,

            ]);

        }

    }



    public function actionProveedornuevo()

    {

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $return=array();

        $model = new Proveedores();

        $marca = Proveedores::find()->where(['isDeleted'=>0])->all();

        $provincia=  Provincias::find()->where(['estado' => "ACTIVO"])->all();

        if (isset($_POST) and !empty($_POST)) {



                //echo 'OK';

                $data = $_POST;

                //Model header

                $model = new Proveedores();

                $model->nombre = $data['nombre'];

                $model->descripcion = $data['descripcion'].'.';

                $model->ruc = $data['ruc'];

                $model->contacto = $data['contacto'];

                $model->cargocontacto = $data['cargo'];

                $model->telefono = $data['telefono'];

                $model->provincia = $data['provincia'];

                $model->ciudad = $data['ciudad'];

                $model->direccion = $data['direccion'];

                $model->correo = $data['correo'];

                $model->persona =  $data['persona'];

                $model->credito = 0;

                $model->usuariocreacion = Yii::$app->user->identity->id;

                $model->isDeleted = 0;

                $model->estatus =  $data['estado'];

                $saveModel=$model->save();

                //var_dump($_POST);

                $flagHeader = true;

                if ($saveModel) {

                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);

                }else{

                    var_dump($model->errors);

                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el proveedor.","resp" => false, "id" => "");

                }

            return json_encode($return);

        } else {

            return $this->render('proveedornuevo', [

                'provincia' => $provincia,

                'model' => $model,

            ]);

        }

    }



    public function actionCategorias()

    {

        return $this->render('categorias');

    }



    public function actionProveedor()

    {

        return $this->render('proveedor');

    }



    public function actionMarcas()

    {

        return $this->render('marcas');

    }



    public function actionPresentaciones()

    {

        return $this->render('presentaciones');

    }



    public function actionTipos()

    {

        return $this->render('tipos');

    }







    /**



     * Updates an existing QuinielaHead model.



     * If update is successful, the browser will be redirected to the 'view' page.



     * @param integer $id



     * @return mixed



     */



    public function actionActualizar($id)



    {

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        $model = new Productos();

        if (isset($_POST) and !empty($_POST)) {

            $model = $this->findModel($id);

            //$uploadFile= $this->subirImagen($_FILES["imagen"]);

            //$uploadFileM= $this->subirImagen($_FILES["imagenmobile"]);

            //(var_dump($model));

            if($_FILES["image"]["name"]){

                $uploadFile= $this->subirImagen($_FILES["image"]);

                $uploadFileM= $this->subirImagen($_FILES["imageresponsive"]);

                if ($uploadFile["success"] && $uploadFileM["success"])

                {

                    $data = $_POST;

                    $model->nombreproducto = $data['nombreproducto'];

                    $model->descripcion = $data['descripcion'];

                    $model->image = $uploadFile["Nombrearchivo"];

                    $model->imageresponsive = $uploadFileM["Nombrearchivo"];

                    $model->link = $data['enlace'];

                    $model->orden =  $data['orden'];

                    $model->estatus =  $data['estado'];

                    if ($model->save()) {

                        $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);

                    }else{

                        $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el banner.","resp" => false, "id" => "");

                    }

                }else{

                    $return=array("success"=>false,"Mensaje"=>"Error al subir la imagen, Mensaje: ".$uploadFile["Mensaje"],"resp" => false, "id" => "");

                }

            }else{

                $data = $_POST;

                $model->titulo = $data['nombre'];

                $model->descripcion = $data['descripcion'];

                $model->link = $data['enlace'];

                $model->orden =  $data['orden'];

                $model->estatus =  $data['estado'];

                if ($model->save()) {

                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);

                }else{

                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el banner.","resp" => false, "id" => "");

                }



            }





            echo json_encode($return);

        } else {

            $model = $this->findModel($id);

            $flagDetail = false;

            $modelDetail = array();



            return $this->render('actualizar', [

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



    public function actionProductoseliminar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $model = Productos::findOne($id);
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

     * Finds the QuinielaHead model based on its primary key value.

     * If the model is not found, a 404 HTTP exception will be thrown.

     * @param integer $id

     * @return QuinielaHead the loaded model

     * @throws NotFoundHttpException if the model cannot be found

     */

    protected function findModel($id)

    {

        if (($model = Productos::findOne($id)) !== null) {

            return $model;

        } else {

            throw new NotFoundHttpException('The requested page does not exist.');

        }

    }



}
