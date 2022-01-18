<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Roles;
use common\models\Rolespermisos;
use backend\components\Log_errores;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/12/21
 * Time: 11:47
 */

class Usuarios_roles extends Component
{

    public function getRoles($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getPermiso($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Cuentas::find()->where(["codigoant"=>$id])->one();
            if ($result)
            {
                $result=$result["codigoant"].' ('.$result["nombre"].')';
            }else{
                $result="NINGUNO";
            }
        }else{
            $result= false;
        }
        return $result;
    }

    public function Nuevo($roles)
    {
        //$date = date("Y-m-d H:i:s");
        $idrol=0;
        $idmodulo=0;
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
            $error=false;
            if ($modelRol->save()):
                $idrol=$modelRol->id;
                if ($roles["modulousuarios"]=="on"){
                    $modelRolpermiso= new Rolespermisos;
                    $modelRolpermiso->idrol=$modelRol->id;
                    //$modelRolpermiso->idmodulo=1;
                    $modelRolpermiso->usuariocreacion=Yii::$app->user->identity->id;
                    $modelRolpermiso->estatus="ACTIVO";
                    if (!$modelRolpermiso->save()){ $error=false; $this->callback(1,$idrol,$modelRolpermiso->errors); return false; }
                }
                if ($roles["modulocontable"]=="on"){
                    $modelRolpermiso= new Rolespermisos;
                    $modelRolpermiso->idrol=$modelRol->id;
                    $modelRolpermiso->idmodulo=2;
                    $modelRolpermiso->usuariocreacion=Yii::$app->user->identity->id;
                    $modelRolpermiso->estatus="ACTIVO";
                    if (!$modelRolpermiso->save()){ $error=false; $this->callback(1,$idrol,$modelRolpermiso->errors); return false; }
                }

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

    public function callback($tipo,$id,$error)
    {
        switch ($tipo) {
            case 1:
                // callback para la función nuevo
                $modelRolpermiso= Rolespermisos::deleteAll(["idrol"=>$id]);
                //$modelRolpermiso->delete();
                
                $modelRol= Roles::find()->where(["id"=>$id])->one();
                $modelRol->delete();

                $log= new Log_errores;
                $observacion="ID: ".$id;
                echo $log->Nuevo("ROLES",$error,$observacion,0,Yii::$app->user->identity->id);

                return true;
                break;
            
            default:
                # code...
                break;
        }
    }
 


}