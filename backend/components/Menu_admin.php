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
        $menuModel= Menuadmin::find()->where(["tipo"=>"WEB","idparent"=>"0","estatus"=>"ACTIVO","isDeleted"=>0])->orderBy(["orden"=>SORT_ASC])->all();
        foreach ($menuModel as $key => $data) {
            
            $subMenuModel= Menuadmin::find()->where(["tipo"=>"WEB","idparent"=>$data->id,"estatus"=>"ACTIVO","isDeleted"=>0])->orderBy(["orden"=>SORT_ASC])->all();
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
        $idmenu=0;
        $modelMenu= new Menuadmin;
        $result=false;
        if ($roles):
            $modelMenu->nombre=$roles["nombre"];
            $modelMenu->icono=$roles["icono"];
            $modelMenu->link=$roles["link"];
            $modelMenu->orden=$roles["orden"];
            $modelMenu->idparent=$roles["superior"];
            $modelMenu->usuarioc=Yii::$app->user->identity->id;
            $modelMenu->usuariom=Yii::$app->user->identity->id;
            //$modelMenu->fechacreacion=$roles->idfactura;
            $modelMenu->isDeleted=0;
            $modelMenu->estatus="ACTIVO";
            //var_dump($roles);
            $error=false;
            if ($modelMenu->save()):
                $error=false;
                return array("response" => true, "id" => $modelMenu->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
            else:
                $this->callback(1,$idmenu,$modelMenu->errors,"Menu_admin -> Nuevo");
                //var_dump($modelRol->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            endif;
        else:
            $this->callback(1,0,"NO POST","Menu_admin -> Nuevo");
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;
        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Actualizar($id,$roles)
    {
        //$date = date("Y-m-d H:i:s");
        $idmenu=0;
        $modelMenu= Menuadmin::find()->where(["id"=>$id])->one();
        $result=false;
        if ($roles):
            if ($modelMenu):
                $modelMenu->nombre=$roles["nombre"];
                $modelMenu->icono=$roles["icono"];
                $modelMenu->link=$roles["link"];
                $modelMenu->orden=$roles["orden"];
                $modelMenu->idparent=$roles["superior"];
                $modelMenu->usuariom=Yii::$app->user->identity->id;
                //$modelMenu->fechacreacion=$roles->idfactura;
                //var_dump($roles);
                $error=false;
                if ($modelMenu->save()):
                    $error=false;
                    return array("response" => true, "id" => $modelMenu->id, "mensaje"=> "Registro actualizado","tipo"=>"success", "success"=>true);
                else:
                    $this->callback(1,$idmenu,$modelMenu->errors,"Menu_admin -> Actualizar");
                    //var_dump($modelRol->errors);
                    return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
                endif;
            else:

            endif;
        else:
            $this->callback(1,0,"NO POST","Menu_admin -> Actualizar");
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
        endif;
        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function callback($tipo,$id,$error,$funcion)
    {
        switch ($tipo) {
            case 1:
                $log= new Log_errores;
                $observacion="ID: ".$id;
                $log->Nuevo("MENU ADMIN",$error,$observacion,0,Yii::$app->user->identity->id);

                return true;
                break;
            
            default:
                # code...
                break;
        }
    }
 


}