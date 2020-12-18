 

<?php $__env->startSection('title', 'Mantenimiento de Registro de Postulante de Simulacro'); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

            <h2>Mantenimiento de Registro de Postulante de Simulacro</h2>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Postulante</h4>
      </div>
        <input  name="_token"  type="hidden" id="_token"  value="<?= csrf_token(); ?>">
        <br>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">CODIGO:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="txtcodigo" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">PROCESO:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
              <select id="txtproceso" class="form-control" name="txtproceso" required>
              <option value="">Seleccione</option>
                <?php $__currentLoopData = $proceso; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                  <option value="<?php echo e($proceso->id); ?>"><?php echo e($proceso->descripcion); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">ESCUELA:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
              <select id="txtescuela" class="form-control" name="txtescuela" required>
              <option value="">Seleccione</option>
                <?php $__currentLoopData = $escuela; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $escuela): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                  <option value="<?php echo e($escuela->IDESCUELA); ?>"><?php echo e($escuela->DESCRIPCIONESCUELA); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">AMBIENTE:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
              <select id="txtambiente" class="form-control" name="txtambiente" required>
              <option value="">Seleccione</option>
                <?php $__currentLoopData = $ambiente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ambiente): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                  <option value="<?php echo e($ambiente->CODIGOAMBIENTE); ?>"><?php echo e($ambiente->DESCRIPCIONAMBIENTE); ?> - <?php echo e($ambiente->CANTIDADINSCRITOS); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">APELLIDOS Y NOMBRES:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="txtapellidosynombres" name="txtapellidosynombres" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">DNI:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="txtdni" name="txtdni" class="form-control" type="text" maxlength="8">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">FECHA DE PAGO:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="txtfechapago" name="txtfechapago" class="form-control" type="date">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">OP. VOUCHER:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="txtopvoucher" name="txtopvoucher" class="form-control" type="text" maxlength="6">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">CELULAR:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="txtcelular" name="txtcelular" class="form-control" type="text" maxlength="9">
              </div>
            </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
  <script src="<?php echo e(asset('js/myjs/configuracion/JS_ADM005.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>