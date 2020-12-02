<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
  @parent


  
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Tarifas por Modalidad de Examen<small> - Mantenimiento</small></h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

           <a>
            <button id="btnEliminar" type="button" class="navbar-right btn btn-danger" data-toggle="modal">
              <span class="fa fa-times-circle"></span> Eliminar
            </button>
            </a>
            
            <a>
            <button id="btnActualizar"  onclick="addForm()" type="button" class="navbar-right btn btn-warning"  >
              <span class="fa fa-pencil"></span> Editar 
            </button>
            </a> 

            <a>
            <button id="btnNuevo"  type="button" class="navbar-right btn btn-primary"  >
              <span class="fa fa-plus"></span> Nuevo
            </button>
            </a> 
            
          


            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <table id="myTable" style="font-size: 13px" width="100%" class="table table-hover table-bordered display nowrap">
  				<th>CODIGO</th>
		                <th>CODIGO MODALIDAD</th>
		                <th>DESCRIPCIÓN</th>
		                <th>NOTA</th>
		                <th>COSTO TARIFA</th>
		                
		<tbody>
                <?php $__currentLoopData = $tarifas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarifas): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                <tr>
                       <td><?php echo e($tarifas->idtarifa); ?></td>
                       <td><?php echo e($tarifas->idmodalidad); ?></td>
                       <td><?php echo e($tarifas->descripcion); ?></td>
                       <td><?php echo e($tarifas->nota); ?></td>
                       <td><?php echo e($tarifas->costotarifa); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

            </tbody>
              </table>
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
        <h4 class="modal-title" id="myModalLabel2">Nueva Tarifa con su Modalidad</h4>
      </div>
   
      <form id="formAulas" class="form-horizontal form-label-left">
        
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Descripción:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="descripcion" type="text" class="form-control" name="descripcion" placeholder="PB0@">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Nota:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="nota" type="text" class="form-control" name="nota" placeholder="Nota">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Costo Tarifa: </label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="costo" type="text" class="form-control" name="costo" placeholder="Costo">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Modalidad:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="modalidad" type="text" class="form-control" name="modalidad" placeholder="Modalidad">
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

  <link href="<?php echo e(asset('css/jquery.Jcrop.css')); ?>" rel="stylesheet">
 
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

  <script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/dataTables.responsive.min.js')); ?>"></script>
     <!-- PNotify -->
  <script src="<?php echo e(asset('js/pnotify.js')); ?>"></script>
  <script src="<?php echo e(asset('js/pnotify.buttons.js')); ?>"></script>
  <script src="<?php echo e(asset('js/pnotify.nonblock.js')); ?>"></script>
  <script src="<?php echo e(asset('js/bootbox.min.js')); ?>"></script>
 <script src="<?php echo e(asset('js/ie10-viewport-bug-workaround.js')); ?>"></script>
   <script src="<?php echo e(asset('js/validator.min.js')); ?>"></script>
   <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>




    <script type="text/javascript">

   function addForm() {
        
     
        $('#modal-form').modal('show');
        $(this).removeData('#modal-form');

        $('.modal-title').text('Actualizar datos Aula');
      }





</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>