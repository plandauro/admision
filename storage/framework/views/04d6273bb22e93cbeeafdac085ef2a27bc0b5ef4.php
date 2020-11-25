<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formNuevaTarifa"  class="form-horizontal" data-toggle="validator" >
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">

          <div class="form-group">
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="idtarifa1"  type="hidden" class="form-control" name="idtarifa1" placeholder="Codigo Tarifa">
              </div>
            </div>

                  <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Descripción:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="descripcion1" type="text" class="form-control" name="descripcion1" placeholder="Descripción">
              </div>
            </div>
            
          <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Nota:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="nota1" type="text" class="form-control" name="nota1" placeholder="Capacidad">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Costo Tarifa:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="costotarifa1" type="text" class="form-control" name="costotarifa1" placeholder="Costo Tarifa">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Modalidad:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                         <input id="idmodalidad1" type="numeric" class="form-control" name="idmodalidad1" placeholder="Modalidad">
                </select>
              </div>
                
            </div>
            </div>

                <div class="modal-footer">
                    <button id="btnEditar"  type="submit" class="btn btn-primary btn-save">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>

            </form>
        </div>
    </div>
</div>
