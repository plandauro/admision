 

<?php $__env->startSection('title', 'REPORTE DE CALIFICACION ASISTENCIA - CANALES'); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

            <h2>Reporte de asistencia - HOJA DE IDENTIFICACION - Canal </h2>
                 <ul class="nav navbar-right panel_toolbox">
              <li style="margin-right: 10px">
                <h4> Filtros de busqueda:</h4>
              </li>
              <li style="margin-right: 15px">

              </li>
              <li style="margin-right: 10px">
                <select style="width: 150px" id="tipobusqueda" onchange="cargarCombo()" class="form-control" name="" id="">
                  <option value="0">Seleccione</option>
                  <option value="2">Por escuela</option>
                  <option value="5">Por asistencia</option>
                </select>
              </li>
              <li style="margin-right: 10px">
                <select id="dato" style="width: 250px" onchange="consultaProducto()" disabled="true" class="form-control" name="" id="">
                  <option value="0">Todos</option>
                </select>
              </li>
              <li>
              <button id="btnActualizar"  type="button" class="navbar-right btn btn-primary"  >
                <span class="fa fa-pencil"></span> Actualizar
              </button>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div id="alertCanales" style="display: none;"  class="alert alert-info  alert-dismissible fade in" role="alert">
            <p id="mensajeCanales"></p>
        </div>
          <div class="x_content">
            <p> <strong id="message"></strong></p>
              <table id="myTable" width="100%" class="table table-hover table-bordered">
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="myModalsistencia" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Asistencia - Canal</h4>
      </div>
       <input  name="_token"  type="hidden" id="_token"  value="<?=csrf_token();?>">
<br>
<div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">APELLIDOS Y NOMBRES:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="nombres" type="text" class="form-control" placeholder="">
              </div>
            </div>            
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">CODIGO POSTULANTE:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="codcepre" type="text" class="form-control" placeholder="000000">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">CODIGO LITHO:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="codlitho" class="form-control" type="text" placeholder="000000">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">CANAL CEPRE:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="canalcepre" type="text" class="form-control" placeholder="">
              </div>
            </div>            
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">CANAL LITHO:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="canallitho" type="text" class="form-control" placeholder="">
              </div>
            </div>
        <br><br><br><br><br><br><br><br><br>
        <div id="alertCanalesS" style="display: none;" role="alert">
            <p id="mensajeCanalesS"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button id="btnGrabar" class="btn btn-primary">Guardar</button>
        </div>

    </div>
  </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/buttons.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/dataTables.buttons.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/jszip.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/pdfmake.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
  <script src="<?php echo e(asset('js/buttons.html5.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/buttons.print.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/myjs/rep-postulante-calificacion-Cepre-Canales-HI-2.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>