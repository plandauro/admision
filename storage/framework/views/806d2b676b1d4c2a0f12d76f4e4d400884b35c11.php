

<?php $__env->startSection('title', 'Reporte de Ingresantes'); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Reporte de Ingresantes</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li style="margin-right: 15px">
                <h4> Filtros de busqueda:</h4>
              </li>
              <li style="margin-right: 15px">
                <select style="width: 120px" id="idproceso" onchange="consultaProducto()" class="form-control" name="" id="">
                  <?php $__currentLoopData = $procesos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <option value="<?php echo e($proceso->id); ?>"><?php echo e($proceso->descripcion); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </select>
              </li>
            </ul>
            <div class="clearfix"></div>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/buttons.dataTables.min.css')); ?>">

<style>
  .td-formatos{
    font-size: 15px; text-align: center;
  }
  .td-formatos > a{
    margin: 0px 3px 0px 3px;
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
 <script src="<?php echo e(asset('js/dataTables.buttons.min.js')); ?>"></script>
 <script src="<?php echo e(asset('js/jszip.min.js')); ?>"></script>
 <script src="<?php echo e(asset('js/pdfmake.min.js')); ?>"></script>
 <script src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
 <script src="<?php echo e(asset('js/buttons.html5.min.js')); ?>"></script>
 <script src="<?php echo e(asset('js/buttons.print.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/myjs/rep-ingresante.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>