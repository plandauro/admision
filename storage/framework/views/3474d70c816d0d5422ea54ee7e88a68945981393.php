<?php $__env->startSection('title', 'RESULTADOS DEL EXAMEN GENERAL 2020-II'); ?>
<?php $__env->startSection('content'); ?>
@parent

<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Reporte de Examen General Ingeniería Civil turno mañana</h2>
          <br> <br>
          <div class="col-md-2">
            <button><a href="<?php echo e(url('llenar-respuestas-2020-2-ICM')); ?>">Proceso de Calificación</a></button>
          </div>

          <ul class="nav navbar-right panel_toolbox">
            <li style="margin-right: 15px">
              <h4> Filtros de busqueda:</h4>
            </li>
            <li style="margin-right: 15px">
              <select style="width: 200px" id="tipobusqueda" onchange="cargarCombo()" class="form-control" name="" id="">
                <option value="0">Postulantes Examen Especial</option>
                <option value="24">Por escuela</option>
              </select>
            </li>
            <li>
              <select id="dato" style="width: 150px" onchange="consultaProducto()" disabled="true" class="form-control" name="" id="">
                <option value="0">Todos</option>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/myjs/rep-postulante-calificacion-2020-2-ICM.js')); ?>"></script>
<script>
  $(document).ready(function() {
        $('#ididentificacion').click(function() {

            var nombre = $("#nombre").val();

            $.ajax({
                type: "POST",
                url: 'rep-calificacion-2020-2-ICM',
                success: function(data) {
                  if (data.existe == "") {

                    $("#alert1").show(0).delay(15000).hide(0);
                    $("#message1").text("No existe el archivo ... Por favor subirlo el DDL");

                  } else {

                    $("#alert1").show(0).delay(15000).hide(0);
                    $("#message1").text("Se cargo correctamente");
                  }
                  window.location.href;
                }
              }
            });
        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>