<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\Botones;
use common\models\LoginForm;
use common\models\Cierreanio;
use common\models\Cierreaniodetalle;
use common\models\Entregas;


/**
 * Site controller
 */
class ProcesosController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    public function actionVercierreanio($id)
    {
        $cierreanio= Cierreanio::find()->where(['id' => $id, "isDeleted" => 0])->one();
        
        $cierreaniodetalle= Cierreaniodetalle::find()->where(['item' => $cierreanio->idperiodo, "isDeleted" => 0])->all();

        return $this->render('vercierreanio', [
            'cierreanio' =>$cierreanio,
            'cierreaniodetalle' =>$cierreaniodetalle,
           // 'entregasdetalle' => Diariodetalle::find()->where(['diario' => $entregas->diario, "isDeleted" => 0])->all(),
        ]);

    }
 

    public function actionCierreanioreg()
    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "cierreanio";
        $model = Cierreanio::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->limit(1000)->all();
        $arrayResp = array();
        $count = 0;
        $view = "cierreanio";
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $arrayResp[$key]['periodo'] = $data->idperiodo0->descripcion;

                //$arrayResp[$key]['departamento'] = $data->iddepartamento0->nombre;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                        //  array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
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
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                    
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionCierredeanio()
    {
        return $this->render('cierredeanio');
    }

 

}
