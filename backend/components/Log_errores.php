<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Roles;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/12/21
 * Time: 11:47
 */

class Usuarios_roles extends Component
{

    public function getLog($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->one();
        }
    }
 
    public function Nuevo($modulo,$error)
    {
        //$date = date("Y-m-d H:i:s");
        $modelRol= new Roles;
        $result=false;
        if ($roles):
            $modelRol->nombre=$roles["nombrerol"];
            $modelRol->descripcion=$roles["descripcion"];
            $modelRol->usuariocreacion=Yii::$app->user->identity->id;
            //$modelRol->fechacreacion=$roles->idfactura;
            $modelRol->isDeleted=0;
            $modelRol->estatus="ACTIVO";
            //var_dump($roles);

            if ($modelRol->save()):
                return true;
            else:
                //var_dump($modelRol->errors);
                return false;
            endif;
        else:
            $result=false;
        endif;
        return $result;
    }

    


}