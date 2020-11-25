 

<?php $__env->startSection('title', 'MANTENIMIENTO DE MATERIA'); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

            <h2>Mantenimiento de Materia</h2>
                 <ul class="nav navbar-right panel_toolbox">
              <li style="margin-right: 15px">
                <h4> Botones de Acciones:</h4>
              </li>
              <li style="margin-right: 15px">
                
              </li>
              <li>
              <button id="btnNuevo"  type="button" class="navbar-right btn btn-success"  >
                <span class="fa fa-plus"></span> Nuevo
              </button>
              </li>
              <li>
              <button id="btnActualizar"  type="button" class="navbar-right btn btn-warning"  >
                <span class="fa fa-pencil"></span> Actualizar
              </button>
              </li>
              <li>
              <button id="btnEliminar"  type="button" class="navbar-right btn btn-danger"  >
                <span class="fa fa-times-circle"></span> Eliminar
              </button>
              </li>
            </ul>
            <div class="clearfix">
              
            </div>

          </div>
          <div id="alertDuplicado" style="display: none;"  class="alert alert-info  alert-dismissible fade in" role="alert">
            <p id="mensajeDuplicado"></p>
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

  <div id="myModalDuplicado" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Mantenimiento de Materia</h4>
      </div>
   
        
        
                                          <input  name="_token"  type="hidden" id="_token"  value="<?= csrf_token(); ?>">



<br>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">CODIGO:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="codigo" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">DESCRIPCION:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="descripcion" name="descripcion" type="text" class="form-control" onkeyup="mayus(this);">
              </div>
            </div>
        <br><br><br><br>
        <div id="alertDuplicadoS" style="display: none;" role="alert">
            <p id="mensajeDuplicadoS"></p>
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
  <script src="<?php echo e(asset('js/myjs/materia.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>