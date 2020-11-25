 

<?php $__env->startSection('title', 'MANTENIMIENTO DE PREGUNTAS'); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

            <h2>Mantenimiento de Preguntas Usadas</h2>
                 <ul class="nav navbar-right panel_toolbox">

              <li style="margin-right: 15px">
                <h4> Botones de Acciones:</h4>
              </li>
              <li style="margin-right: 15px">
                
              </li>
              <li>
              <button id="btnActualizar"  type="button" class="navbar-right btn btn-warning"  >
                <span class="fa fa-pencil"></span> Actualizar
              </button>
              </li>
            </ul>

            <div class="clearfix">
              
            </div>

          </div>
          <div id="alertDuplicado" style="display: none;"  class="alert alert-info  alert-dismissible fade in" role="alert">
            <p id="mensajeDuplicado"></p>
        </div>
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
              <li style="margin-right: 15px">
                <select style="width: 200px" id="tipobusqueda" onchange="cargarCombo()" class="form-control" name="" id="">
                  <option value="0">Todos las Opciones</option>
                  <option value="6">Por materia</option>
                </select>
              </li>
              <li>
                <select id="dato" style="width: 250px" onchange="consultaProducto()" disabled="true" class="form-control" name="" id="">
                  <option value="0">Todos</option>
                </select>
              </li>
            </ul>
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
        <h4 class="modal-title" id="myModalLabel2">Mantenimiento de Preguntas</h4>
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12">DIFICULTAD:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select name="iddificultad" id="iddificultad" class="form-control">
                          <option value="0">(Seleccionar)</option>
                          <?php $__currentLoopData = $dificultad; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dificultades): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <option value="<?php echo e($dificultades->iddificultad); ?>"><?php echo e($dificultades->nombre); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">MATERIA:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select name="idmateria" id="idmateria" class="form-control">
                          <option value="0">(Seleccionar)</option>
                          <?php $__currentLoopData = $materias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarifa): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <option value="<?php echo e($tarifa->idmateria); ?>"
                          
                      
                          
                          ><?php echo e($tarifa->nombre); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">NOMBRE:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea rows="8" cols="50" id="descripcion" name="descripcion" type="text" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">A1:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="a1" name="a1" type="text" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">A2:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="a2" name="a2" type="text" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">A3:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="a3" name="a3" type="text" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">A4:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="a4" name="a4" type="text" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">A5:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="a5" name="a5" type="text" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">AC:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="ac" name="ac" type="text" class="form-control">
              </div>
            </div>        
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br>
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
<link rel="stylesheet" href="<?php echo e(asset('css/jquery.dataTables.m