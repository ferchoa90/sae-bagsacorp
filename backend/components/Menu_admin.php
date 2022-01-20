<?php
namespace backend\components;
use Yii;
use yii\helpers\Url;
use backend\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Menuadmin;
use common\models\Roles;
use common\models\Rolespermisos;
use backend\components\Log_errores;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/12/21
 * Time: 11:47
 */

class Menu_admin extends Component
{

    public function getMenu($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getMenuadmin($rol=0,$context='')
    {
        if ($all){
            
        }else{
            
        }
        //$menu=['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest];
        $menuModel= Menuadmin::find()->where(["tipo"=>"WEB","idparent"=>"0","estatus"=>"ACTIVO"])->orderBy(["orden"=>SORT_ASC])->all();
        foreach ($menuModel as $key => $data) {
            
            $subMenuModel= Menuadmin::find()->where(["tipo"=>"WEB","idparent"=>$data->id,"estatus"=>"ACTIVO"])->orderBy(["orden"=>SORT_ASC])->all();
            if ($subMenuModel)
            {
                $subMenu= array();
                foreach ($subMenuModel as $key => $data2) {
                    //if ($data2->nombre=="Mensajes"){ $template='<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-yellow">123</small></span></a>'; }
                    if ($data2->nombre=="Mensajes"){
                        $template='<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-green">0</small></span></a>';
                        $subMenu[]=array('label' => $data2->nombre, 'icon' => $data2->icono, 'url' => [$data2->link],'active' => '/'.$context == $data2->link,'template'=>$template);  
                    }else{
                        $subMenu[]=array('label' => $data2->nombre, 'icon' => $data2->icono, 'url' => [$data2->link],'active' => '/'.$context == $data2->link);  
                    }
                }
                $menu[]= array('label' => $data->nombre, 'icon' => $data->icono, 'items' => $subMenu);            
            }else{
               $menu[]= array('label' => $data->nombre, 'icon' => $data->icono, 'url' => [$data->link]);            
            } 
        }
        return $menu;
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
                    $modelRolpermiso->idmodulo=1;
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
                return array("response" => true, "id" => $modelRol->id, "Mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
            else:
                //var_dump($modelRol->errors);
                return array("response" => true, "id" => 0, "Mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            endif;
        else:
            return array("response" => true, "id" => 0, "Mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;
        return array("response" => true, "id" => 0, "Mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
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
                $log->Nuevo("ROLES",$error,$observacion,0,Yii::$app->user->identity->id);

                return true;
                break;
            
            default:
                # code...
                break;
        }
    }
 


}