<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 17/03/22
 * Time: 22:29
 */

class Archivos extends Component
{
    public $ruta;
    public $tamanio;
    public $tipoarchivo;
    public $formatosdefecto;

    function __construct($ruta='',$tamanio='',$tipoarchivo='',$formatosdefecto='')
    {
        $rutadefecto='E:/xampp-new/htdocs/sae-bagsacorp/backend/web/images/pedidos/';
        $rutadefecto='C:/xampp/htdocs/sae-bagsacorp/backend/web/images/pedidos/';
        $rutadefectoprod = '/var/www/html/frontend/web/images/pedidos/';
        $tamaniodefecto="10000000"; //MB
        $tipoarchivodefecto="*.jpg|*.png|*.pdf|";
        $this->ruta=$rutadefecto;
        $this->tamanio=$tamaniodefecto;
        $this->tipoarchivo=$tipoarchivo;
        $this->formatosdefecto=$formatosdefecto;
    }

    public function Subirarchivo($archivo,$sobreescribir=true,$modulo="")
    {
        //$this->ruta = '/xampp-new/htdocs/cpn2/frontend/web/images/';
        $target_dir = $this->ruta;
        //echo $this->ruta;
        //var_dump($archivo);
        foreach ($archivo as $key => $value) {

            $target_file = $target_dir . basename($value["name"]);
            $nombreArchivo=basename($value["name"]);
            $uploadOk = 0;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
                $check = getimagesize($value["tmp_name"]);
                //var_dump($check);
                if($check != false) {
                    //echo "File is an image - " . $check["mime"] . ".";

                    $uploadOk = 1;
                } else {
                    //echo "File is not an image.";
                    $return=array("success"=>false,"Mensaje"=>"El archivo no es una imagen.");
                    $uploadOk = 0;
                }
            // Check if file already exists
            if ($sobreescribir==false)
            {
                if (file_exists($target_file)) {
                    //echo "Sorry, file already exists.";
                    $return=array("success"=>false,"Mensaje"=>"La imagen ya existe en el repositorio.");
                    $uploadOk = 0;
                }
            }

            // Check file size
            if ($value["size"] > $this->tamanio) {
                $return=array("success"=>false,"Mensaje"=>"La imagen subida excede el límite de tamaño.");
                //echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $return=array("success"=>false,"Mensaje"=>"El archivo debe se una imagen válida. Extensión: ".$imageFileTypes);
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $return=array("success"=>false,"Mensaje"=> $return["Mensaje"]);
                //echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                //echo move_uploaded_file($value["tmp_name"], $target_file);
                if (move_uploaded_file($value["tmp_name"], $target_file)) {
                    $return=array("success"=>true,"mensaje"=>"Imagen subida.","nombrearchivo"=>$nombreArchivo);
                    //$return=array("success"=>"true","Mensaje"=>"OK");
                    //echo json_encode($return);
                    //echo "The file ". basename( $value["name"]). " has been uploaded.";
                } else {
                    $return=array(["success"=>false,"data"=>$return]);
                }
            }
        }
        return $return;
    }

    public function auditoria(){

    }


}