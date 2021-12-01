<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Grid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use backend\assets\AppAsset;
/* @var $this yii\web\View */


$this->title = 'SAE - Sistema Administrativo Contable';
?>
 

<?php

 
$grid= new Grid;
  
$columnas= array( 
  array('columna'=>'# Fac', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
  array('columna'=>'Razón social', 'datareg' => 'nombres', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
  array('columna'=>'Valor', 'datareg' => 'total', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
  array('columna'=>'Fecha Hora', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
  array('columna'=>'', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

?>

<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row w-100 d-flex ">
      <div class=" mr-auto p-2  ">
        <h1 class="h4 mb-0 text-gray-800">Recaudaciones</h1>
      </div>
    </div>
  </div>
</div>

<?php
/*
echo $grid->getGrid( 
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'facturasreg')
        )
);
 */
?>
 
 
        <!-- Begin Page Content -->

        <div class="container-fluid">
       
          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->

            <div class="col-xl-12 col-lg-12">

              <div class="card shadow mb-4">

                <!-- Card Header - Dropdown -->



                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between align-middle">

           

                <td>
                  <a href="/frontend/web/eliminarfactura/verdescarga?id=12" title="Ver" class="btn  btn-primary btn-sm btnedit">
                  <i class="fas fa-eye"></i></a>&nbsp;<a href="/frontend/web/eliminarfactura/actualizardescarga?id=12" title="Actualizar" class="btn  btn-info btn-sm btnedit">
                  <span class="fas fa-pencil-alt"></span></a>&nbsp;
                  <button type="submit" alt="Eliminar" title="Eliminar" data-id="12" data-name="id" onclick="deleteReg(this)" class="btn  btn-danger btn-sm btnhapus">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
 

                  

                </div>

             

               

              </div>

            </div>

          </div>


 



      <!-- End of Main Content -->

      <!-- Footer -->

      <footer class="sticky-footer bg-white">

        <div class="container my-auto">

          <div class="copyright text-center my-auto">

            <span>Copyright &copy; ACEP SISTEMAS 2020</span>

          </div>

        </div>

      </footer>

      <!-- End of Footer -->

    </div>

    <!-- End of Content Wrapper -->

  </div>

  <style>
        .table
        {
            margin-bottom: 0rem !important;
        }
        .dataTables_length
        {
          display: inline-block;
        }
        .dataTables_filter
        {
          display: inline-block;
        }
    </style>
<script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
   <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
  
   