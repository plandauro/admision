<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formNuevas"  class="form-horizontal" data-toggle="validator" >
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">

    <div class="form-group"  style="display:none">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Codigo Ambiente:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="codAmbiente1" type="text" class="form-control" name="codAmbiente1" placeholder="PB0@">
              </div>
            </div>

                  <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Nombre Aula:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="descripcion1" type="text" class="form-control" name="descripcion1" placeholder="PB0@">
              </div>
            </div>



   <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Capacidad:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="CapacidadAula1" type="text" class="form-control" name="CapacidadAula1" placeholder="Capacidad">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Pabellón:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="ubicacionAula1" type="text" class="form-control" name="ubicacionAula1" placeholder="Ubicacion">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Modalidad:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
             

                     <select  required="required" id="isoarea1" name="isoarea1" class="form-control"
                           
                            <?php if($areas == ""): ?>
                                  disabled >
                                  <option value="0">(Selecciona)</option>
                                </select>
                            <?php else: ?>
                            >
                            <option value="0">(Selecciona)</option>

                            <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                          <option value="<?php echo e($area->idarea); ?>"
                               
                                      <?php if($area->descripcion == Auth::user()->isoarea): ?>
                                        selected <?php endif; ?>>
                                        
                                    <?php echo e($area->descripcion); ?>

                                  </option>

                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                </select>
                            <?php endif; ?>


        </div>



                </div>
                
                 <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Orden de Cobertura:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="ordenCobertura" type="text" class="form-control" name="ordenCobertura" placeholder="Ubicacion">
              </div>
            </div>

                <div class="modal-footer">
                    <button id="btnEditar"  type="submit" class="btn btn-primary btn-save">Actualizar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>

            </form>
        </div>
    </div>
</div>



