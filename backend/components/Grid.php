<?php

namespace backend\components;

use yii\helpers\Url;
use yii\helpers\Html;

use Yii;

use backend\models\User;

use backend\models\Configuracion;

use yii\web\View;

use backend\assets\AppAsset;

use yii\base\Component;

use yii\base\InvalidConfigException;





/**

 * Created by VSCODE.

 * User: Mario Aguilar

 * Date: 06/09/21

 * Time: 22:22

 */



class Grid extends Component

{



    public function getGrid($objetos,$return=false)

    {

        $resultado;



           // var_dump($objetos['tipo']);



//echo $objetos;

        switch ($objetos[0]['tipo']) {

            case 'datagrid':

                $resultado.= $this->getGridBoostrap($objetos,$objetos[0]['tipo'],$objetos[0]['nombre'], $objetos[0]['id'], $objetos[0]['columnas'], $objetos[0]['clase'], $objetos[0]['estilo'], $objetos[0]['col'], $objetos[0]['adicional'], $objetos[0]['url']);



                break;



            case 'separador':

                $resultado.= $this->getSeparador($objetos[0]['clase'],$objetos[0]['estilo'], $objetos[0]['color']);

                break;

            default:



                break;

        }



        if ($return)

        {

            return $resultado;

        }else{

            echo $resultado;

        }

    }



    public function getGridBoostrap($objetos, $tipo, $nombre='', $id='',$columnas='', $clase='', $estilo='', $col='', $adicional='',$url)

    {



        $input='';

        $iddefault='table';

        $nombredefault='table';

        (!$id)? $id=$iddefault : $id=$id;

        (!$nombre)? $nombre=$nombredefault : $nombre=$nombre;

        (!$clase)? $clase=$classdefault : $clase=$clase;

        $classdefault='table table-striped table-bordered table-hover';

        $boxbody='<div class="box-body">';

        $enddiv='</div>';

        $columnas='';



        foreach($objetos[0]['columnas'] as $col):



            $columnas.='

                <th>'.$col['columna'].'</th>

            '

            ;



        endforeach;



        $resultado='

        <div class="card">

            <div class="card-body">

                <table id="'.$nombre.'"  name="'.$id.'" class="'.$classdefault.'">

                    <thead>

                    <tr class="tableheader">

                    '.$columnas.'

                    </tr>

                    </thead>

                    <tbody>

                    </tbody>

                </table>

            </div><!-- /.box -->

        </div>

       ';

        if ($boxbody):

            $resultado=$resultado;

        endif;

        $this->getRegistrarJS($nombre,$url,$objetos[0]['columnas']);

        return $resultado;



    }



    public function getRegistrarJS($nombre,$url,$datareg)

    {
        $urlrefer=$_SERVER["HTTP_REFERER"];
        $token=Yii::$app->request->getCsrfToken();
        $urlfinal= explode("/",$urlrefer);
        foreach ($urlfinal  as $value) {
            $urlfinal=$value;
        }

        $data='';

        foreach ($datareg as $value) {

            $data.='{ "data": "'.$value['datareg'].'" },';

        }

        //echo $data;



        $script = <<< JS

function deleteReg(id) {
    var id_reg = id;
    urlflag=false;
    console.log('url2: '+'$urlfinal')
    console.log(id)
    swal({
            title: "Eliminar Registro",
            text: "Esta seguro de eliminar el registro?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#32bc38",
            confirmButtonText: "Continuar",
            closeOnConfirm: true
        },
        function () {
            var url = (urlflag == 'false') ? '$urlfinal' + "/delete?id=" + id_reg : "$urlfinal/ delete?id=" + id_reg;
            $.post(url, {
                '_csrf-frontend': '$token'
            }).done(function (data) {
                loading(0);
                $.notify('Registro eliminado', "success");
            });
        });
}

$(document).ready(function () {

//alert('$nombre')
   loading(1);
    var url = '$url';
        $.post(url, { '_csrf-backend': '$token', '_csrf-frontend': '$token' })
        .done(function(data) {
                var data = JSON.parse(data);
            $('$nombre').DataTable({
                "paging": true,
                "fixedHeader": true,
                "lengthChange": true,
                "scrollX": true,
                "colReorder": true,
                "searching": true,
                "orderCellsTop": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 25,
                "data": data,
                "language": {
                    "search": "Buscar: ",
                    "zeroRecords": "No se encontraron registros para la búsqueda.",
                    "info": "Página _PAGE_ de _PAGES_ |  Total: _MAX_ registros",
                    "infoEmpty": "No existen registros.",
                    "lengthMenu": "Registros por página  _MENU_",
                    "infoFiltered": "(Filtrado de _MAX_ registros).",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "paginate": {
                            "first": "Inicio",
                        "last": "Final",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                },
                "columns": [
                        $data
                ]
            });
            loading(0);
        });
    });

JS;
Yii::$app->getView()->registerJs($script, \yii\web\View::POS_END);

    }





}