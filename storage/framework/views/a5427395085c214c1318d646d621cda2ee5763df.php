

<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Proceso de Postulación <small>Mantenimiento</small></h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Lista de Procesos</h2>
            <button type="button" class="navbar-right btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">
              <span class="fa fa-plus"></span> Nuevo Proceso
            </button>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <table id="myTable" style="font-size: 13px" width="100%" class="table table-hover table-bordered display nowrap"></table>
          </div>
        </div>
      </div>
    </div>
  </div>

<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Nuevo Proceso de Postulación</h4>
      </div>
      <form id="formproceso" class="form-horizontal form-label-left">
        <div class="modal-body">
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Descripción:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" class="form-control" name="descripcion" placeholder="Año-Semestre (2018-I)">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Director:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" class="form-control" name="director" placeholder="Nombre del Director">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Responsable:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" class="form-control" name="responsable" placeholder="Nombre del Responsable">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Resolución:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" class="form-control" name="resolucion" placeholder="Número de Resolución">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Fecha Resolución:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="date" class="form-control" name="fecharesolucion" placeholder="Nombre del Responsable">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Costo Carpeta:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="number" class="form-control" min="0" name="costocarpeta" placeholder="0.00">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Costo Prospecto:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="number" class="form-control" min="0" name="costoprospecto" placeholder="0.00">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Fecha Examen Ordinario:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="date" class="form-control" min="0" name="fechaexaordinario" placeholder="0.00">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Fecha Examen Extraordinario:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="date" class="form-control" min="0" name="fechaexaextraordinario" placeholder="0.00">
              </div>
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('css'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/responsive.dataTables.min.css')); ?>">
  <!-- PNotify -->
  <link href="<?php echo e(asset('css/pnotify.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('css/pnotify.buttons.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('css/pnotify.nonblock.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/dataTables.responsive.min.js')); ?>"></script>
     <!-- PNotify -->
  <script src="<?php echo e(asset('js/pnotify.js')); ?>"></script>
  <script src="<?php echo e(asset('js/pnotify.buttons.js')); ?>"></script>
  <script src="<?php echo e(asset('js/pnotify.nonblock.js')); ?>"></script>
  <script src="<?php echo e(asset('js/myjs/postular.js')); ?>"></script>
  <script src="<?php echo e(asset('js/myjs/crud-proceso.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>