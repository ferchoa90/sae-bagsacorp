<?php

namespace backend\controllers;
use Yii;
use backend\components\Globaldata;
use backend\components\Botones;
use backend\components\Menu_admin;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\db\Query;
use backend\models\User;
use common\models\Menuadmin;
use kartik\export\ExportMenu;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\data\ArrayDataProvider;

class ConfiguracionesController extends Controller
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

    public function actionMenuadmin()
    {
        return $this->render('menuadmin');
    }

    public function actionFormmenuadmin()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        $menuadmin= new Menu_admin;
        $menuadmin= $menuadmin->Nuevo($_POST);
        //die(var_dump($_POST));
        $response=$menuadmin;

        //return $this->render('formrol');
        return json_encode($response);

    }

    public function actionVermenuadmin($id)
    {
        $menuadmin= Menuadmin::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('vermenuadmin', [
            'menuadmin' =>$menuadmin,
            //'rolpermisos' => Rolespermisos::find()->where(['idrol' => $rol->id])->all(),
        ]);

    }


    public function actionMenuadminreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $page = "Menuadmin";
        $model = Menuadmin::find()->where(['isDeleted' => '0'])->orderBy(["idparent" => SORT_ASC,"nombre" => SORT_ASC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $arrayMenu=array();
                if ($id == "idparent"){
                    if ($text==0){
                        $arrayResp[$key]['superior'] =" - ";
                        //$arrayMenu[$text]=;
                    }else{
                        //echo ' P: '.$text;
                        $modelParent = Menuadmin::find()->where(['id' => $text])->one();
                        $arrayResp[$key]['superior'] = $modelParent->nombre;
                    }

                }
                $view='menuadmin';
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "icono") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "link") ) { $arrayResp[$key][$id] = $text; }

                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }

                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionNuevomenu()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        //$menuadmin = Menuadmin::find()->where(['isDeleted' => '0'])->orderBy(["nombre" => SORT_ASC])->all();
        $menuadmin = Menuadmin::find()->where(['isDeleted' => '0',"idparent"=>"0"])->orderBy(["nombre" => SORT_ASC])->all();
        $menuadminArray=array();
        $cont=0;
        foreach ($menuadmin as $key => $value) {
            if ($cont==0){ $menuadminArray[$cont]["value"]="Seleccione / Ninguno"; $menuadminArray[$cont]["id"]=0; $cont++; }
            $menuadminArray[$cont]["value"]=$value->nombre;
            $menuadminArray[$cont]["id"]=$value->id;
            $cont++;
        }

        return $this->render('nuevomenu', [
            //'sucursal' => $sucursal,
            'menuadmin' => $menuadminArray,
        ]);
    }

    public function actionReimpresion()
    {
        return $this->render('reimpresion');
    }


    public function actionMenuadmineliminar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $model = Menuadmin::findOne($id);
        $model->isDeleted = 1;

        if ($model->save())
        {
            return true;
        }else{
            return false;
        }
        //return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Inventario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }



}
