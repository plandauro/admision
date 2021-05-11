<?php $__env->startSection('title', 'Reporte de Pagos Subidos'); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
          
             <a>
            <button id="btnNuevo"  type="button" class="navbar-right btn btn-primary"  >
              <span class="fa fa-plus"></span> Nuevo
            </button>
            </a> 
            
            
            <h2>Reporte de Pagos Subidos</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li style="margin-right: 15px">
                <h4> Filtros:</h4>
              </li>
               <li style="margin-right: 15px">
                <select style="width: 120px" id="idproceso" onchange="consultar()" class="form-control" name="">
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
  
  
  
  
  
  
  
  
  
  <div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Registrar Pago</h4>
      </div>
   
        
        
                                          <input  name="_token"  type="hidden" id="_token"  value="<?= csrf_token(); ?>">




            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Dni:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="dni" class="form-control" type="number" name="descripcion" placeholder="dni">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Nro Operacion:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="nroperacion" type="text" class="form-control"   placeholder="nro de operacion">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Fecha de Pago:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="fechadepago" class="form-control"  type="date"   placeholder="fecha de pago">
              </div>
            </div>
            <div class="form-group">
              <label id="ho" class="control-label col-md-5 col-sm-5 col-xs-12">Hora de Pago:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
             
                <input id="horadepago" type="text" class="form-control"   placeholder="hora de pago">


          </div>
          <br>
 <br> 
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Banco:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">

<select class="form-control" id="slBanco">
<option value="BANCO INTERBANK">BANCO INTERBANK</option>
<option value="BANCO DE LA NACION">BANCO DE LA NACION</option>
</select>



              </div>
            </div>
      
        <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Importe:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">

                <input id="importe" type="text" class="form-control" name="CapacidadAula" placeholder="importe">




              </div>
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
  <script src="<?php echo e(asset('js/myjs/rep-pagosexportado.js')); ?>"></script>
  
  
      <script type="text/javascript">






 $('#btnNuevo').click(function() {
         $('#myModal').modal('show');

 });



 $('#btnGrabar').click(function() {
        _token= $('#_token').val();
        dni= $('#dni').val();
        fechadepago= $('#fechadepago').val();
        horadepago= $('#horadepago').val();
        slBanco= $('#slBanco').val();
        nroperacion= $('#nroperacion').val();
        importe= $('#importe').val();
        urlbase = $("body").attr('urlbase');
        url=urlbase+"/grabarPago";

      $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',
  	data: {
              _token: _token,
              dni: dni,
              fechadepago: fechadepago,
              horadepago: horadepago,
              slBanco: slBanco,
              nroperacion: nroperacion,
              importe: importe
          },
      complete: function(response) {
            
      $('#myModal').modal('hide');
      $('#dni').val(" ");
      $('#fechadepago').val(" ");
      $('#horadepago').val(" ");
      $('#slBanco').val("BANCO INTERBANK");
      $('#nroperacion').val(" ");
      $('#importe').val(" ");
        location.reload();

             }
                  
                  
                  
                  });
                  
                  
                  

 });




         
                  
                  
                  
                  
</script>
  
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>