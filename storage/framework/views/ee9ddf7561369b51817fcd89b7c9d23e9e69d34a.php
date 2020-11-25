<?php $__env->startSection('title', 'Calificar'); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Calificar</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li style="margin-right: 15px">
                <h4> Tipo de busqueda:</h4>
              </li>
              <li style="margin-right: 15px">
                <select style="width: 200px" class="form-control" name="" id="">
                  <option value="">Todos los postulantes</option>
                  <option value="">Por ambiente</option>
                  <option value="">Por escuela</option>
                </select>
              </li>
              <li>
                <select style="width: 150px" class="form-control" name="" id="">
                  <option value=""></option>
                </select>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <table id="myTable" class="table table-striped">
                <tr>
                  <th>Apellidos y Nombres</th>
                  <th>N° Documento</th>
                  <th>Ambiente</th>
                  <th>Escuela</th>
                  <th></th>
                  <th></th>
                </tr>
                <?php $__currentLoopData = $postulaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postulacion): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <tr>
                  <td><?php echo e($postulacion->apepaterno); ?> <?php echo e($postulacion->apematerno); ?> <?php echo e($postulacion->nombre); ?> </td>
                  <td><?php echo e($postulacion->dni); ?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
 <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  $(document).ready(function(){
      $('#myTable').DataTable();
  });
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>