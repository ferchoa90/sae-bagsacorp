<?php

namespace backend\controllers;

use app\components\GlobalData;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\db\Query;

use backend\models\User;
use common\models\Sucursal;

 


/**
 * Default controller for the `admin` module
 */
class UsuariosController extends Controller
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



    /**
     * Renders the index view for the module
     * @return string
     */
    
    public function actionRegistros()

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "usuarios";
        $model = User::find()->where(["isDeleted"=>"0"])->andfilterWhere(["<>","tipo","Superadmin"])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($model as $key => $data) {

            foreach ($data as $id => $text) {

                //$arrayResp[$key]['num'] = $count;

                if ($id == "id") {

                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/view?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="fas fa-eye"></i></a>'

                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><i class="fas fa-pencil-alt"></i></a>'

                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'

                        . '<i class="fas fa-trash-alt"></i></button>';

                    //$arrayResp[$key]['button'] = '-';

                }



               

                if ($id == "estatus" and $text == 'Activo') {

                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';

                } elseif ($id == "estatus" and $text == 'Inactivo') {

                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';

                } else {

                    if (($id == "nombres") || ($id == "apellidos") || ($id == "username") ) { $arrayResp[$key][$id] = $text; }

                    if (($id == "tipo") || ($id == "fechacreacion") || ($id == "correo") ) { $arrayResp[$key][$id] = $text; }

                    if (($id == "id")  || ($id == "email")) { $arrayResp[$key][$id] = $text; }

                }

            }

            $count++;

        }



        return json_encode($arrayResp);

    }

    /**
     * Displays a single TriviaHead model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }


        return $this->render('view', [
            'model' => $this->findModel($id),

        ]);
    }

    /**
     * Creates a new TriviaHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNuevo()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $sucursal = Sucursal::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_ASC])->all();  

        $flagHeader = false;
        $flagDetail = false;

        if (isset($_POST) and !empty($_POST)) {
            $data = $_POST;
             

            //Model header
            $model = new User();
            $model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($data['password']);
            $model->auth_key=$data['password'];
            $model->nombres=$data['nombres'];
            $model->username=$data['nombreu'];
            $model->apellidos=$data['apellidos'];
            $model->email=$data['correo'];
            $model->idsucursal=$data['sucursal'];
            $model->tipo=$data['tipo'];
            $model->cedula=$data['cedula'];
            $model->estatus=$data['estado'];
            $model->estatus="Activo";
            $model->fotoperfil="user2-160x160.png";
            $model->status=10;
            $model->isDeleted=0;
            $model->creado_por=Yii::$app->user->identity->id;
            $model->created_at=Yii::$app->user->identity->id;
            $model->updated_at=Yii::$app->user->identity->id;
            
            
          
            if ($model->save()) {
                echo json_encode(array("resp" => true, "id" => $model->id, "Mensaje"=> "Usuario agregado correctamente","success"=>true));
            } else {
                echo json_encode(array("resp" => false, "id" => "", "Mensaje" =>"Hubo un error al agregar el usuario","success"=>false,"Error"=>$model->errors,"data"=>$data));
            }

        } else {
            return $this->render('nuevo', [
                'sucursal' => $sucursal,
            ]);
        }

    }

    /**
     * Updates an existing TriviaHead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $sucursal = Sucursal::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_ASC])->all();  
        $model = $this->findModel($id);
        if (isset($_POST) and !empty($_POST)) {
            $data = $_POST;
 
            //Model header
            if ($data['password'])
            {
                $model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($data['password']);
            }
                $model->nombres=$data['nombres'];
                $model->username=$data['nombreu'];
                $model->apellidos=$data['apellidos'];
                $model->email=$data['correo'];
                $model->idsucursal=$data['sucursal'];
                $model->tipo=$data['tipo'];
                $model->cedula=$data['cedula'];
                $model->estatus=$data['estado'];

            if ($model->save()) {
                echo json_encode(array("resp" => true, "id" => $model->id, "mensaje" => "Usuario actualizado correctamente"));
            } else {
                echo json_encode(array("resp" => false, "id" => "", "mensaje" => "Error al actualizar el usuario"));
            }

        } else {
            return $this->render('update', [
                'model' => $model,
                'sucursal' => $sucursal,
            ]);
        }
    }

    /**
     * Deletes an existing TriviaHead model.
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
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TriviaHead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TriviaHead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)

    {

        if (($model = User::findOne($id)) !== null) {

            return $model;

        } else {

            throw new NotFoundHttpException('The requested page does not exist.');

        }

    }

}

