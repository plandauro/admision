<?php $__env->startSection('title', 'RESULTADOS DEL EXAMEN DEL ADMISION 2020-II'); ?>
<?php $__env->startSection('content'); ?>
  @parent
  
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Reporte de Calificacion Por Alumno</h2>
            <div class="clearfix"></div>
          </div>
          <ul class="nav navbar-right panel_toolbox">
              <li style="margin-right: 15px">
                <h4>CODIGO POSTULANTE: </h4>
              </li>
              <li style="margin-right: 15px">
                    <input type="text" name="codigopostulante" id="codigopostulante"  class="form-control" maxlength="6" onkeypress="return justNumbers(event);">
              </li>
              <li>
                  <button type="button" onclick="consultaProducto();" class="btn btn-primary">Buscar Postulante</button>
              </li>
          </ul>

          <div class="x_content">
            <p> <strong id="message"></strong></p>
              <table id="myTable" width="100%" class="table table-hover table-bordered">
                <tfoot>
                  <tr>
                      <th colspan="8" style="text-align:right">Puntaje Total:</th>
                      <th></th>
                  </tr>
                </tfoot>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/dataTables.buttons.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/jszip.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/pdfmake.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
  <script src="<?php echo e(asset('js/buttons.html5.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/buttons.print.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/myjs/rep-postulante-calificacion-por-postulante-2020-2.js')); ?>"></script>

  <script type="text/javascript">
  function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>